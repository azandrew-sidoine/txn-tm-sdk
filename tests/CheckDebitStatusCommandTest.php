<?php

use Drewlabs\Txn\Exceptions\RequestException;
use Drewlabs\Txn\TMoney\CheckDebitStatusCommand;
use Drewlabs\Txn\TMoney\DebitTransaction;
use Drewlabs\Txn\TMoney\Tests\Stubs\CurlMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\TransactionServerConfigMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\TransactionStatusArgMockFactory;
use PHPUnit\Framework\TestCase;

class CheckDebitStatusCommandTest extends TestCase
{
    use TransactionStatusArgMockFactory;
    use TransactionServerConfigMockFactory;
    use CurlMockFactory;

    public function test_check_credit_status_throws_an_exception_if_curl_request_returns_a_result_with_status_code_not_equals_to_200()
    {
        // Initialize
        $server = $this->createTransactionServerConfigMock();
        $arg = $this->createTransactionStatusArgMock();
        $curl = $this->createCurlMock(500, json_encode(['message' => 'Internal Server Error']));
        $command = new CheckDebitStatusCommand($server, $curl);

        // Assert
        $this->expectException(RequestException::class);
        $this->expectExceptionCode(500);
        $this->expectExceptionMessage("/GET http://127.0.0.1:8000/api/v1/transaction?" . (string)$arg . " : Unknown Request error");

        // Act
        $command->handle($arg);
    }

    public function test_check_credit_status_returns_a_credit_transaction_result_case_server_return_response_with_status_code_200()
    {
        // Initialize
        $server = $this->createTransactionServerConfigMock();
        $arg = $this->createTransactionStatusArgMock();
        $curl = $this->createCurlMock(200, json_encode([
            'data' => [
                [
                    'code' => 2000,
                    'refTmoney' => 'T#REF802',
                    'typeRequete' => 'CREDIT',
                    'refCommande' => 'REFCOMMAND',
                    'montant' => 24500,
                    'nomPartenaire' => 'MERCHANT',
                    'code' => 200,
                    'message' => 'OK',
                    'dateHeureTmoney' => $at = date('Y-m-d H:i:s'),
                    'idRequete' => $commandId = time() . random_int(1000, 100000),
                    'soldePartenaire' => (float)25000
                ]
            ]
        ]));
        $command = new CheckDebitStatusCommand($server, $curl);

        // Act
        $result = $command->handle($arg);

        // Assert
        $this->assertIsArray($result);
        $this->assertInstanceOf(DebitTransaction::class, $result[0]);
        $this->assertEquals('REFCOMMAND', $result[0]->getReference());
        $this->assertEquals($commandId, $result[0]->getCommandId());
        $this->assertEquals('T#REF802', $result[0]->getTMoneyReference());
        $this->assertEquals($at, $result[0]->getProcessedAt()->format('Y-m-d H:i:s'));
    }

}