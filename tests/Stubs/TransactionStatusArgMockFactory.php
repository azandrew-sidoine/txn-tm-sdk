<?php

namespace Drewlabs\Txn\TMoney\Tests\Stubs;

use Drewlabs\Txn\TMoney\Contracts\TransactionStatusArgInterface;
use Exception;
use PHPUnit\Framework\MockObject\IncompatibleReturnValueException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin TestCase
 */
trait TransactionStatusArgMockFactory
{

    /**
     * Create transaction status arg mock instance
     * 
     * @return MockObject&TransactionStatusArgInterface 
     * @throws Exception 
     * @throws IncompatibleReturnValueException 
     */
    public function createTransactionStatusArgMock()
    {
        $requestId = time().random_int(1000, 100000);

        /**
         * @var MockObject&TransactionStatusArgInterface
         */
        $arg = $this->createMock(TransactionStatusArgInterface::class);

        $arg->method('__toString')
            ->willReturn($requestId);

        return $arg;
    }

}