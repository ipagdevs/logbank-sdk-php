<?php

namespace Kubinyete\Logbank\Model;

use Kubinyete\Logbank\Util\ArrayUtil;
use Throwable;

abstract class Model implements SerializableModelInterface
{
    protected array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    //

    public function get(string $path, $default = null)
    {
        return ArrayUtil::get($path, $this->data, $default);
    }

    public function set(string $path, $value)
    {
        return ArrayUtil::set($path, $this->data, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function __set($name, $value)
    {
        $this->set($name, $value);
    }

    //

    public function jsonSerialize(): array
    {
        return $this->data;
    }

    public static function tryParse(array $data): ?Model
    {
        try {
            return self::parse($data);
        } catch (Throwable $e) {
            return null;
        }
    }

    public static function parse(array $data): Model
    {
        return new static($data);
    }
}
