<?php

namespace Kubinyete\Logbank\Core;

class LogbankEnvironment extends Environment
{
    private const URL_SANDBOX       = 'https://techsavvy-api-sandbox.secure.srv.br/api/v1';
    private const URL_PRODUCTION    = 'https://api-tsv.secure.srv.br/api/v1';

    public static function sandbox(): LogbankEnvironment
    {
        return new static(self::URL_SANDBOX);
    }

    public static function production(): LogbankEnvironment
    {
        return new static(self::URL_PRODUCTION);
    }
}
