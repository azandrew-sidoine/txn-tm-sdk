<?php

use Drewlabs\Txn\TMoney\Contracts\TransactionServerConfigInterface;
use Drewlabs\Txn\TMoney\TransactionServerConfig;
use PHPUnit\Framework\TestCase;

class TransactionServerOptionTest extends TestCase
{

    public function test_transaction_server_option_constructor_creates_a_transaction_server_option_interface()
    {
        // Initialize
        $server = new TransactionServerConfig('http://127.0.0.1:80/api/v1/txn-credit', base64_encode('Server Token'));

        // Assert
        $this->assertInstanceOf(TransactionServerConfigInterface::class, $server);
    }

    public function test_transaction_server_option_get_endpoint_returns_the_configured_url_string()
    {
        // Initialize
        $server = new TransactionServerConfig('http://127.0.0.1:80/api/v1/txn-credit', base64_encode('Server Token'));

        // Assert
        $this->assertEquals('http://127.0.0.1:80/api/v1/txn-credit', $server->getEndpoint());
    }

    public function test_transaction_server_option_get_bearer_token_returns_the_configured_bearer_token()
    {
        // Initialize
        $bearerToken = base64_encode('Server Token');
        $server = new TransactionServerConfig('http://127.0.0.1:80/api/v1/txn-credit', $bearerToken);

        // Assert
        $this->assertEquals($bearerToken, $server->getBearerToken());
    }
}