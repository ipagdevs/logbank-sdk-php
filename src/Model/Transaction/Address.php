<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Address extends Model
{
    public function __construct(string $street, string $number, string $complement, string $neighborhood, string $city, string $state, string $country, string $zipcode)
    {
        parent::__construct(
            Assert::value(compact('street', 'number', 'complement', 'neighborhood', 'city', 'state', 'country', 'zipcode'))->assocRules([
                'street' => 'asTrim;asLimit,150;lgt,1',
                'number' => 'asTrim;asLimit,50;alphanumeric;lgt,1',
                'complement' => 'asTrim;asLimit,128;lgt,1',
                'neighborhood' => 'asTrim;asLimit,150;lgt,1',
                'city' => 'asTrim;asLimit,100;lgt,1',
                'state' => 'asTrim;lbetween,2,2;alphanumeric',
                'country' => 'country2',
                'zipcode' => 'asTrim;asLimit,10;asDigits;lgt,1',
            ])->get()
        );
    }
}
