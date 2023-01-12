<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Phone extends Model
{
    public function __construct(int $ddi, int $ddd, string $number)
    {
        parent::__construct(
            Assert::value(compact('ddi', 'ddd', 'number'))->assocRules([
                'ddi' => 'asDigits;asLimit,5;lgt,1',
                'ddd' => 'asDigits;asLimit,5;lgt,1',
                'number' => 'asDigits;asLimit,32;lgt,1',
            ])->get()
        );
    }
}
