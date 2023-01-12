<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Item extends Model
{
    public function __construct(string $name, string $value, int $amount)
    {
        parent::__construct(
            Assert::value(compact('name', 'value', 'amount'))->assocRules([
                'name' => 'asTrim;asLimit,150;lgt,1',
                'value' => 'asDecimal',
                'amount' => 'int;gte,1',
            ])->get()
        );
    }
}
