<?php

use Drewlabs\Txn\TMoney\AuthorizationResponse;
use Drewlabs\Txn\TMoney\Contracts\AuthorizationResponseInterface;
use PHPUnit\Framework\TestCase;

class AuthorizationResponseTest extends TestCase
{

    public function test_authorization_response_constructor_creates_instance_of_authorization_response_interface()
    {
        $response = new AuthorizationResponse([]);

        $this->assertInstanceOf(AuthorizationResponseInterface::class, $response);
    }

    public function test_authorization_response_get_status_code_returns_status_code_passed_to_constructor()
    {
        $response = new AuthorizationResponse([], 201);

        $this->assertEquals(201, $response->getStatusCode());
    }

    public function test_authorization_response_is_initialize_with_200_as_status_code_if_no_status_code_is_passes()
    {
        $response = new AuthorizationResponse([]);

        $this->assertEquals(200, $response->getStatusCode());
    }


    public function test_authorization_response_get_token_returns_token_value_passed_in_initialization_attributes()
    {
        $response = new AuthorizationResponse(['token' => rtrim(base64_encode('Authorization Token'), '=')]);

        $this->assertEquals(rtrim(base64_encode('Authorization Token'), '='), $response->getToken());
    }
}
