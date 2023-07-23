<?php

use Drewlabs\Txn\TMoney\AuthorizationServer;
use Drewlabs\Txn\TMoney\Contracts\AuthorizationServerInterface;
use PHPUnit\Framework\TestCase;

class AuthorizationServerTest extends TestCase
{
    public function test_authorization_server_constructor_creates_authorization_server_interface()
    {
        $server = new AuthorizationServer('http://127.0.0.1:3000', '/api/oauth/token');

        $this->assertInstanceOf(AuthorizationServerInterface::class, $server);
    }


    public function test_authorization_server_get_host_return_the_configured_host()
    {
        // Initialize
        $server = new AuthorizationServer('http://127.0.0.1:3000', '/api/oauth/token');

        // Assert
        $this->assertEquals('http://127.0.0.1:3000', $server->getHost());
    }

    public function test_authorization_server_get_token_url_returns_a_string_with_server_host_prepend_to_configured_token_path()
    {
        // Initialize
        $server = new AuthorizationServer('http://127.0.0.1:3000', '/api/oauth/token');

        // Assert
        $this->assertEquals('http://127.0.0.1:3000/api/oauth/token', $server->getTokenUrl());
    }

    public function test_authorization_server_get_token_url_returns_the_exact_token_path_string_passed_as_parameter_if_path_is_full_url()
    {
        $server = new AuthorizationServer('http://127.0.0.1:3000', 'http://auth.example.com/api/oauth/token');

        // Assert
        $this->assertEquals('http://auth.example.com/api/oauth/token', $server->getTokenUrl());
    }
}