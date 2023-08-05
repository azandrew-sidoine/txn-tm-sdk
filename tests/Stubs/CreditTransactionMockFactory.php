<?php

namespace Drewlabs\Txn\TMoney\Tests\Stubs;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;
use Drewlabs\Txn\TMoney\Contracts\CreditResultInterface;
use PHPUnit\Framework\MockObject\IncompatibleReturnValueException;
use Exception;

/**
 * @var TestCase
 */
trait CreditTransactionMockFactory
{

    /**
     * Create credit transaction
     * 
     * @param int|null $commandId 
     * @param int $commandCode 
     * @param float|int $amount 
     * @param string $tReference 
     * @param string $merchant 
     * @param float|int $merchanBalance 
     * @param mixed $processedAt 
     * @return MockObject&CreditResultInterface 
     * @throws IncompatibleReturnValueException 
     * @throws Exception 
     */
    public function createCreditTransaction(int $commandId = null, int $commandCode = 200, float $amount = 40000,  $tReference = 'T#62497', string $merchant = 'Merchant', float $merchanBalance = 250000, $processedAt = null)
    {
        /**
         * @var MockObject&CreditResultInterface
         */
        $transaction = $this->createMock(CreditResultInterface::class);

        $transaction->method('getTMoneyReference')
            ->willReturn($tReference);

        $transaction->method('getProcessedAt')
            ->willReturn($processedAt ?? date('Y-m-d H:i:s'));

        $transaction->method('getRequestType')
            ->willReturn('CREDIT');

        $transaction->method('getValue')
            ->willReturn($amount);

        $transaction->method('getPayeer')
            ->willReturn('2124567890');

        $transaction->method('getMerchant')
            ->willReturn($merchant ?? 'Merchant');

        $transaction->method('getCode')
            ->willReturn($commandCode);

        $transaction->method('getReasonPhrase')
            ->willReturn(200 === $commandCode ? 'OK' : 'COMMAND ERROR');

        $transaction->method('getCommandId')
            ->willReturn($commandId ?? time() . random_int(1000, 10000));

        $transaction->method('getMerchantBalance')
            ->willReturn($merchanBalance ?? 25000);

        return $transaction;
    }
}
