<?php

use Drewlabs\Txn\TMoney\Contracts\CommandResultInterface;
use Drewlabs\Txn\TMoney\CreditCommand;
use Drewlabs\Txn\TMoney\DebitCommand;
use Drewlabs\Txn\TMoney\Tests\Stubs\CurlMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\TransactionCommandArgMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\TransactionServerConfigMockFactory;
use Drewlabs\Txn\TMoney\Exceptions\CommandException;
use PHPUnit\Framework\TestCase;

class DebitCommandTest extends TestCase
{
    
    use TransactionCommandArgMockFactory;
    use TransactionServerConfigMockFactory;
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
        $command = new DebitCommand($server, $curl);

        // Act
        $command->handle($arg);
    }

    public function test_debit_command_handle_returns_a_credit_transaction_instance_if_request_is_successful()
    {
        // Initialize
        $server = $this->createTransactionServerConfigMock();
        $arg = $this->createTransactionCommandArgMock();

        $curl = $this->createCurlMock(200, json_encode([
            'code' => 2000,
            'message' => 'OK',
            'idRequete' => $arg->getCommandId()
        ]));
        $command = new DebitCommand($server, $curl);

        // Act
        $result = $command->handle($arg);

        // Assert
        $this->assertInstanceOf(CommandResultInterface::class, $result);
        $this->assertEquals($arg->getCommandId(), $result->getCommandId());
        $this->assertEquals(2000, $result->getCode());
        $this->assertEquals('OK', $result->getReasonPhrase());
    }

    
    public function test_debit_command_handle_credit_tm_server()
    {
        // Initialize
        // TM_CREDIT_COMMAND_URL
        $serverConfig = $this->createTransactionServerConfigMock(getenv('TM_DEBIT_COMMAND_URL'), getenv('TM_BEARER_TOKEN'));
        $arg = $this->createTransactionCommandArgMock(time().random_int(1000, 10000), 1500, sprintf('REF%s', time().random_int(100, 1000)), '22892146591');
        $command = new DebitCommand($serverConfig);

        $result = $command->handle($arg);
        
        $this->assertInstanceOf(CommandResultInterface::class, $result);
    }

}