<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Transaction extends Model
{
    public function __construct(string $email, string $total_value, int $number_of_installments)
    {
        parent::__construct(
            Assert::value(compact('email', 'total_value', 'number_of_installments'))->assocRules([
                'email' => 'email',
                'total_value' => 'asDecimal',
                'number_of_installments' => 'int;between,1,128',
            ])->get()
        );
    }

    public function setBilling(Billing $value): void
    {
        $this->set('billing', $value->jsonSerialize());
    }

    public function setShipping(Shipping $value): void
    {
        $this->set('shipping', $value->jsonSerialize());
    }

    public function addItem(Item $value): void
    {
        $items = $this->get('items', []);
        $items[] = $value->jsonSerialize();
        $this->set('items', $items);
    }

    public function addPayment(Payment $value): void
    {
        $payments = $this->get('payments', []);
        $payments[] = $value->jsonSerialize();
        $this->set('payments', $payments);
    }
}
