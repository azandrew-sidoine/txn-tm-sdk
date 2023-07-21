<?php

declare(strict_types=1);

namespace Drewlabs\Txn\TMoney\Exceptions;

use Drewlabs\Txn\Exceptions\RequestException;
use Drewlabs\Txn\TMoney\Contracts\CommandErrorInterface;

class CommandException extends RequestException implements CommandErrorInterface
{
    private $command;

    /**
     * creates exception class instances
     * 
     * @param string $command 
     * @param string $message 
     * @param int $code 
     */
    public function __construct(string $command, string $message = 'Unknown Error', int $code = 0)
    {
        parent::__construct($message ?? 'Unknown Error', null === $code ? 0 : $code);
        $this->command = $command;
    }


    public function getCommand()
    {
        return $this->command;
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