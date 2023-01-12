<?php

namespace Kubinyete\Logbank\Model\Transaction;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Billing extends Model
{
    public function __construct(string $primary_document, string $name, string $email, Address $address)
    {
        parent::__construct(
            Assert::value(compact('primary_document', 'name', 'email'))->assocRules([
                'primary_document' => 'asCpf|asCnpj',
                'name' => 'asTrim;asLimit,150;lgt,1',
                'email' => 'email',
            ])->get()
        );

        $this->setAddress($address);
    }

    public function setAddress(Address $address): void
    {
        $this->set('address', $address->jsonSerialize());
    }

    public function addPhone(Phone $phone): void
    {
        $phones = $this->get('phones', []);
        $phones[] = $phone->jsonSerialize();
        $this->set('phones', $phones);
    }
}
