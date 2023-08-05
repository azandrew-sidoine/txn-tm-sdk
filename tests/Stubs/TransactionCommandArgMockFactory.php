<?php

namespace Drewlabs\Txn\TMoney\Tests\Stubs;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Drewlabs\Txn\TMoney\Contracts\TransactionCommandArgInterface;
use Exception;
use PHPUnit\Framework\MockObject\IncompatibleReturnValueException;

/**
 * @mixin TestCase
 */
trait TransactionCommandArgMockFactory
{

    /**
     * Create a transaction command argument
     * 
     * @param int|null $command 
     * @param float|int $amount 
     * @param string $reference 
     * @param string $accountNumber 
     * @return MockObject&TransactionCommandArgInterface 
     * @throws Exception 
     * @throws IncompatibleReturnValueException 
     */
    public function createTransactionCommandArgMock(int $command = null, float $amount = 20000, string $reference = 'REF79647', string $accountNumber = '0112345678')
    {
        $command = $command ?? time() . random_int(1000, 10000);
        /**
         * @var MockObject&TransactionCommandArgInterface
         */
        $arg = $this->createMock(TransactionCommandArgInterface::class);

        $arg->method('getCommandId')
            ->willReturn($command);

        $arg->method('getAccountNumber')
            ->willReturn($accountNumber ?? '0112345678');

        $arg->method('getAmount')
            ->willReturn($amount ?? 20000);

        $arg->method('getReference')
            ->willReturn($reference ?? 'REF79647');

        $arg->method('getCreatedAt')
            ->willReturn(date('Y-m-d H:i:s'));

        $arg->method('getDescription')
            ->willReturn('COMMAND DESCRIPTION');

        return $arg;
    }
}
