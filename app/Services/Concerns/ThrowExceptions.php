<?php

namespace App\Services\Concerns;

use App\Exceptions\RuntimeException;
use Exception;

trait ThrowExceptions
{
    static function throwException(Exception $e)
    {
        throw new RuntimeException($e->getMessage(), $e->getCode(), $e->getPrevious());
    }
}
