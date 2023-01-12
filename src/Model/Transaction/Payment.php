<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Payment extends Model
{
    public function __construct(string $value, int $installments, Card $card)
    {
        parent::__construct(
            Assert::value(compact('value', 'installments'))->assocRules([
                'value' => 'asDecimal',
                'installments' => 'int;gte,1',
            ])->get()
        );

        $this->setCard($card);
    }

    public function setCard(Card $card): void
    {
        $this->set('card', $card->jsonSerialize());
    }
}
