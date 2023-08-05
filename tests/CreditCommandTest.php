<?php

use Drewlabs\Txn\TMoney\Contracts\CreditResultInterface;
use Drewlabs\Txn\TMoney\CreditCommand;
use Drewlabs\Txn\TMoney\Exceptions\CommandException;
use Drewlabs\Txn\TMoney\Tests\Stubs\CreditTransactionMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\CurlMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\TransactionCommandArgMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\TransactionServerConfigMockFactory;
use PHPUnit\Framework\TestCase;

class CreditCommandTest extends TestCase
{
    use TransactionCommandArgMockFactory;
    use TransactionServerConfigMockFactory;
    // use CreditTransactionMockFactory;
    use CurlMockFactory;


    public function test_credit_command_handle_throws_a_command_exception_case_curl_request_response_with_body_having_code_not_equals_2000()
    {
        // Assert
        $this->expectException(CommandException::class);
        $this->expectExceptionMessage('Not Found');
        $this->expectExceptionCode(5000);
        // Initialize
        $server = $this->createTransactionServerConfigMock();
        $arg = $this->createTransactionCommandArgMock();
        $curl = $this->createCurlMock(200, json_encode(['code' => 5000, 'message' => 'Not Found']));
        $command = new CreditCommand($server, $curl);

        // Act
        $command->handle($arg);
    }

    public function test_credit_command_handle_returns_a_credit_transaction_instance_if_request_is_successful()
    {
        // Initialize
        $server = $this->createTransactionServerConfigMock();
        $arg = $this->createTransactionCommandArgMock();

        $curl = $this->createCurlMock(200, json_encode([
            'code' => 2000,
            'refTmoney' => 'T#REF802',
            'typeRequete' => 'CREDIT',
            'refCommande' => $arg->getReference(),
            'montant' => $arg->getAmount(),
            'nomPartenaire' => 'MERCHANT',
            'code' => 200,
            'message' => 'OK',
            'idRequete' => $arg->getCommandId(),
            'soldePartenaire' => (float)25000
        ]));
        $command = new CreditCommand($server, $curl);

        // Act
        $result = $command->handle($arg);

        // Assert
        $this->assertInstanceOf(CreditResultInterface::class, $result);
        $this->assertEquals('T#REF802', $result->getTMoneyReference());
        $this->assertEquals('CREDIT', $result->getRequestType());
        $this->assertEquals($arg->getCommandId(), $result->getCommandId());
        $this->assertEquals($arg->getAmount(), $result->getValue());
        $this->assertEquals('MERCHANT', $result->getMerchant());
        $this->assertEquals(200, $result->getCode());
        $this->assertEquals('OK', $result->getReasonPhrase());
        $this->assertEquals('CREDIT', $result->getRequestType());
        $this->assertEquals($arg->getReference(), $result->getReference());
    }
}
