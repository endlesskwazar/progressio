<?php

namespace App\Application\Utils;

use Exception;

abstract class AbstractValueObject
{
    public function __get(string $propertyName)
    {
        return $this->$propertyName;
    }

    /**
     * @throws Exception
     */
    public function __set(string $propertyName, $value): void
    {
        throw new Exception("Cannot set property {$propertyName}. The object is immutable.");
    }

    public function __isset($name)
    {
        $getter = 'get' . ucfirst($name);
        if (method_exists($this, $getter)) {
            return !is_null($this->$getter());
        }

        return isset($this->$name);
    }
}
