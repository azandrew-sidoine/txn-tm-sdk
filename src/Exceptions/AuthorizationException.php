<?php

declare(strict_types=1);

namespace Drewlabs\Txn\TMoney\Exceptions;

use Exception;

class AuthorizationException extends Exception
{
    public function __construct(string $message = 'UnAuthorized', int $code = 4001)
    {
        parent::__construct($message, $code);
    }
}
