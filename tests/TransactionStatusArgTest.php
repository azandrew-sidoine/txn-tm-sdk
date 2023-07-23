<?php

use Drewlabs\Txn\TMoney\TransactionStatusArg;
use PHPUnit\Framework\TestCase;

class TransactionStatusArgTest extends TestCase
{

    public function test_transaction_status_arg_is_stringable_instance()
    {
        $command = sprintf("%s%s", time(), rand(100, 10000));
        $status = new TransactionStatusArg($command);

        $this->assertEquals($command, (string) $status);
        $this->assertTrue(is_string((string)$status));
    }
}