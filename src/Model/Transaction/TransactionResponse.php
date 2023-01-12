<?php

namespace Kubinyete\Logbank\Model\Transaction;

use DateTimeImmutable;
use DateTimeInterface;
use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class TransactionResponse extends Model
{
    public function __construct(array $data)
    {
        parent::__construct(
            Assert::value($data)->assocRules([
                'nsu_acquirer' => 'null|str',
                'nsu_cancellation_acquirer' => 'null|str',
                'value' => 'int',
                'original_value' => 'int',
                'refunded_value' => 'null|int',
                'installments' => 'int',
                'card_brand_id' => 'int',
                'operation_id' => 'int',
                'channel_id' => 'int',
                'card_number' => 'str',
                'card_holder' => 'str',
                'card_validity_month' => 'str',
                'card_validity_year' => 'str',
                'authorization_number' => 'null|str',
                'authorization_number_cancellation' => 'null|str',
                'start_date' => 'null|str',
                'finish_date' => 'null|str',
                'payment_date' => 'null|str',
                'payment_last_update_date' => 'null|str',
                'cancellation_date' => 'null|str',
                'response_code' => 'null|str',
                'response_message' => 'null|str',
                // card_input_method: TYPED,MAGNETIC_STRIPE,CHIP,CONTACTLESS
                'card_input_method' => 'null|str',
                'gateway_name' => 'null|str',
                'origin' => 'null|str',
                'status' => 'null|str',
                'pay_link_id' => 'null|int',
                'ecommerce_order_number' => 'null|str',
                'ecommerce_order_custom_code' => 'null|str',
                'ecommerce_order_id' => 'null|int',
                'soft_descriptor' => 'null|str',
            ])->get()
        );
    }

    public function getNsuAcquirer(): ?string
    {
        return $this->nsu_acquirer;
    }

    public function getNsuCancellationAcquirer(): ?string
    {
        return $this->nsu_cancellation_acquirer;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function getOriginalValue(): ?int
    {
        return $this->original_value;
    }

    public function getRefundedValue(): ?int
    {
        return $this->refunded_value;
    }

    public function getInstallments(): ?int
    {
        return $this->installments;
    }

    public function getCardBrandId(): ?int
    {
        return $this->card_brand_id;
    }

    public function getOperationId(): ?int
    {
        return $this->operation_id;
    }

    public function getChannelId(): ?int
    {
        return $this->channel_id;
    }

    public function getCardNumber(): ?string
    {
        return $this->card_number;
    }

    public function getCardHolder(): ?string
    {
        return $this->card_holder;
    }

    public function getCardValidityMonth(): ?string
    {
        return $this->card_validity_month;
    }

    public function getCardValidityYear(): ?string
    {
        return $this->card_validity_year;
    }

    public function getAuthorizationNumber(): ?string
    {
        return $this->authorization_number;
    }

    public function getAuthorizationNumberCancellation(): ?string
    {
        return $this->authorization_number_cancellation;
    }

    public function getStartDateString(): ?string
    {
        return $this->start_date;
    }

    public function getStartDate(): ?DateTimeInterface
    {
        return $this->start_date ? new DateTimeImmutable($this->start_date) : null;
    }

    public function getFinishDateString(): ?string
    {
        return $this->finish_date;
    }

    public function getFinishDate(): ?DateTimeImmutable
    {
        return $this->finish_date ? new DateTimeImmutable($this->finish_date) : null;
    }

    public function getPaymentDateString(): ?string
    {
        return $this->payment_date;
    }

    public function getPaymentDate(): ?DateTimeImmutable
    {
        return $this->payment_date ? new DateTimeImmutable($this->payment_date) : null;
    }

    public function getPaymentLastUpdateDateString(): ?string
    {
        return $this->payment_last_update_date;
    }

    public function getPaymentLastUpdateDate(): ?DateTimeImmutable
    {
        return $this->payment_last_update_date ? new DateTimeImmutable($this->payment_last_update_date) : null;
    }

    public function getCancellationDateString(): ?string
    {
        return $this->cancellation_date;
    }

    public function getCancellationDate(): ?DateTimeImmutable
    {
        return $this->cancellation_date ? new DateTimeImmutable($this->cancellation_date) : null;
    }

    public function getResponseCode(): ?string
    {
        return $this->response_code;
    }

    public function getResponseMessage(): ?string
    {
        return $this->response_message;
    }

    public function getCardInputMethod(): ?string
    {
        return $this->card_input_method;
    }

    public function getGatewayName(): ?string
    {
        return $this->gateway_name;
    }

    public function getOrigin(): ?string
    {
        return $this->origin;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function getPayLinkId(): ?int
    {
        return $this->pay_link_id;
    }

    public function getEcommerceOrderNumber(): ?string
    {
        return $this->ecommerce_order_number;
    }

    public function getEcommerceOrderCustomCode(): ?string
    {
        return $this->ecommerce_order_custom_code;
    }

    public function getEcommerceOrderId(): ?int
    {
        return $this->ecommerce_order_id;
    }

    public function getSoftDescriptor(): ?string
    {
        return $this->soft_descriptor;
    }
}
