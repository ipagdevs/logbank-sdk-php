<?php

namespace Kubinyete\Logbank\Model\Auth;

use DateInterval;
use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class AccessToken extends Model
{
    protected const DEFAULT_EXP_LEEWAY = 10;

    protected ?DateTimeInterface $calculatedExpiresIn;
    protected int $leewaySeconds;


    public function __construct(array $data, int $leewaySeconds = self::DEFAULT_EXP_LEEWAY)
    {
        parent::__construct(Assert::value($data)->assocRules([
            'access_token' => 'str',
            'expires_in' => 'null|int',
            'token_type' => 'str',
        ])->get());

        $this->leewaySeconds = $leewaySeconds;
        $this->applyExpiresIn($this->expires_in);
    }

    public function getAccessToken(): string
    {
        return $this->get('access_token');
    }

    public function getExpiresIn(): int
    {
        return $this->get('expires_in');
    }

    public function getTokenType(): string
    {
        return $this->get('token_type');
    }

    protected function applyExpiresIn(int $expiresIn): void
    {
        $seconds = max($expiresIn ?? 0, 0);
        $this->calculatedExpiresIn = (new DateTime())->add(new DateInterval("PT{$seconds}S"));
    }

    public function hasExpired(): bool
    {
        return $this->calculatedExpiresIn ?
            (new DateTime())->add(new DateInterval("PT{$this->leewaySeconds}S")) >= $this->calculatedExpiresIn :
            true;
    }
}
