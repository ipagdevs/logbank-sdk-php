<?php

namespace Kubinyete\Logbank\Core;

use Kubinyete\Logbank\Exception\ExpiredAccessTokenException;
use Kubinyete\Logbank\Exception\HttpException;
use Kubinyete\Logbank\Exception\LogbankException;
use Kubinyete\Logbank\Http\Client\GuzzleHttpClient;
use Kubinyete\Logbank\Http\Response;
use Kubinyete\Logbank\IO\JsonSerializer;
use Kubinyete\Logbank\IO\SerializerInterface;
use Kubinyete\Logbank\Model\Auth\Credentials;
use Kubinyete\Logbank\Model\Auth\AccessToken;
use Kubinyete\Logbank\Model\Transaction\Transaction;
use Kubinyete\Logbank\Model\Transaction\TransactionCancelRequest;
use Kubinyete\Logbank\Model\Transaction\TransactionResponse;
use Throwable;

class LogbankClient extends Client
{
    private const USER_AGENT = 'LogbankSdk (PHP)';
    private const CONTENT_TYPE = 'application/json';

    protected ?AccessToken $accessToken;

    public function __construct(LogbankEnvironment $env)
    {
        parent::__construct(
            $env,
            new GuzzleHttpClient([
                'headers' => [
                    'User-Agent' => self::USER_AGENT,
                    'Content-Type' => self::CONTENT_TYPE,
                    'Accept' => self::CONTENT_TYPE
                ]
            ]),
            new JsonSerializer()
        );

        $this->accessToken = null;
    }

    protected function isAuthRoute(string $url): bool
    {
        return str_ends_with($url, 'client/auth');
    }

    public function authenticate(Credentials $credentials): AccessToken
    {
        $response = $this->post('/client/auth', $credentials->jsonSerialize());
        $response = AccessToken::parse($response->getParsed());

        $this->accessToken = $response;
        return $response;
    }

    public function createTransaction(Transaction $transaction): TransactionResponse
    {
        $response = $this->post('/client/transaction/ecommerce/checkout', $transaction->jsonSerialize());
        $data = $response->getParsed();
        $data = array_is_list($data) ? array_shift($data) : $data;
        return TransactionResponse::parse($data);
    }

    public function cancelTransaction(TransactionCancelRequest $cancel): Response
    {
        $response = $this->delete('/client/transaction/ecommerce/checkout', $cancel->jsonSerialize());
        return $response;
    }

    //

    protected function exceptionThrown(Throwable $e): void
    {
        if ($e instanceof HttpException) {
            $message = $e->getResponse()->getParsedPath('message');
            $errors = $e->getResponse()->getParsedPath('errors', []);
            $class = LogbankException::class;

            throw new LogbankException(
                "* ($class) $message: " . $this->formatErrors($errors),
                0,
                $e,
                $e->getResponse(),
                $e->getStatusCode(),
                $e->getStatusMessage()
            );
        }
    }

    public function request(string $method, string $url, $body, array $query = [], array $header = [], ?SerializerInterface $serializer = null): Response
    {
        if (!$this->isAuthRoute($url)) {
            if (!$this->accessToken || $this->accessToken->hasExpired()) {
                throw new ExpiredAccessTokenException("The current access token has expired, please authenticate again before continuing.");
            }

            $header = array_merge($header, ['Authorization' => 'Bearer ' . $this->accessToken->getAccessToken()]);
        }

        return parent::request($method, $url, $body, $query, $header, $serializer);
    }

    protected function formatErrors($errors): string
    {
        $message = '';

        foreach ($errors as $attr => $error) {
            if (is_array($error)) {
                $message .= $this->formatErrors($error);
            } else {
                $message .= ($attr ? "[$attr]: " : '') . strval($error) . PHP_EOL;
            }
        }

        return $message;
    }
}
