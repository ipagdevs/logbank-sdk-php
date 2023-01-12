<?php

namespace Kubinyete\Logbank\Model\Auth;

use Kubinyete\Assertation\Assert;
use Kubinyete\Logbank\Model\Model;

class Credentials extends Model
{
    public function __construct(int $project_id, string $client_id, string $client_secret)
    {
        parent::__construct(
            Assert::value(compact('project_id', 'client_id', 'client_secret'))->assocRules([
                'project_id' => 'int',
                'client_id' => 'str',
                'client_secret' => 'str',
            ])->get()
        );
    }
}
