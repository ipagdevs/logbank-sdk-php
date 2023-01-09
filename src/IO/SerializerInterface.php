<?php

namespace Kubinyete\Logbank\IO;

interface SerializerInterface
{
    function serialize(array $data): string;
    function unserialize(string $data): array;
}
