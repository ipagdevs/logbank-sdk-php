<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Card extends Model
{
    public function __construct(
        string $number,
        string $brand_name,
        string $owner_name,
        string $document,
        string $validity_month,
        string $validity_year,
        string $security_code,
        string $owner_email,
        string $owner_phone
    ) {
        $data = Assert::value(compact(
            'number',
            'brand_name',
            'owner_name',
            'document',
            'validity_month',
            'validity_year',
            'security_code',
            'owner_email',
            'owner_phone'
        ))->assocRules([
            '#number' => 'asCardNumber',
            'brand_name' => 'asTrim;asLimit,50;lgt,1',
            'owner_name' => 'asTrim;asLimit,50;lgt,1.',
            'document' => 'asCpf|asCnpj',
            'validity_month' => 'string;numeric;lbetween,2,2;between,1,12',
            'validity_year' => 'string;numeric;lbetween,2,2;between,0,99',
            '#security_code' => 'asDigits;asLimit,8',
            'owner_email' => 'email',
            'owner_phone' => 'asDigits;asLimit,15;lgt,1',
        ])->get();

        $data['bin'] = substr($data['number'], 0, 6);
        $data['end'] = substr($data['number'], -4);

        parent::__construct($data);
    }
}
