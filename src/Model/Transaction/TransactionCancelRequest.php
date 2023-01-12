<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class TransactionCancelRequest extends Model
{
    public function __construct(string $payment_id, int $amount)
    {
        parent::__construct(
            Assert::value(compact('payment_id', 'amount'))->assocRules([
                'payment_id' => 'str;lgt,1',
                'amount' => 'int',
            ])->get()
        );
    }

    // protected function decimalToInt(string $amount, int $decimalPadding = 2): int
    // {
    //     $splt = explode('.', $amount);

    //     // 0 -> 0
    //     // 1 -> 10 -> 100
    //     $monetary = intval($splt[0]) * 10 * 10;
    //     $cents = intval(str_pad($splt[1] ?? '', $decimalPadding, '0', STR_PAD_RIGHT));

    //     return $monetary + $cents;
    // }
}
