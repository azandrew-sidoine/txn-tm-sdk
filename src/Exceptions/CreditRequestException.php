<?php

declare(strict_types=1);

namespace Drewlabs\Txn\TMoney\Exceptions;

use Drewlabs\Txn\TMoney\Contracts\CommandErrorInterface;
use Exception;

class CreditRequestException extends Exception implements CommandErrorInterface
{
    /**
     * creates exception class instance
     * 
     * @param string $message 
     * @param int $code 
     */
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }

    public function getErrorCode()
    {
        return $this->getCode();
    }

    public function getErrorMessage()
    {
        return $this->getMessage();
    }
}
