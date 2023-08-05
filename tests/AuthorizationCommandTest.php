<?php

use Drewlabs\Txn\TMoney\AuthorizationCommand;
use Drewlabs\Txn\TMoney\AuthorizationResponse;
use Drewlabs\Txn\TMoney\Exceptions\AuthorizationException;
use Drewlabs\Txn\TMoney\Tests\Stubs\AuthorizationCommandArgMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\AuthorizationServerMockFactory;
use Drewlabs\Txn\TMoney\Tests\Stubs\Callback;
use Drewlabs\Txn\TMoney\Tests\Stubs\CurlMockFactory;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AuthorizationCommandTest extends TestCase
{
    use CurlMockFactory;
    use AuthorizationServerMockFactory;
    use AuthorizationCommandArgMockFactory;

    public function test_authorization_command_handle_throws_an_authorization_exception_if_request_returns_response_with_status_not_equals_2000()
    {
        // Assert
        $this->expectException(AuthorizationException::class);
        $this->expectExceptionMessage('Server Error.');

        // Initialize
        $curl = $this->createCurlMock(200, json_encode(['status' => ['code' => 5000, 'message' => 'Server Error.']]));
        $serverConfig = $this->createAuthorizationServerMock();
        $arg = $this->createAuthorizationCommandArg();
        $command = new AuthorizationCommand($serverConfig, $curl);

        // Act
        $command->handle($arg);
    }

    public function test_authorization_command_returns_an_authorization_response_if_server_return_an_http_response_with_2000_status_code()
    {
        // Initialize
        $curl = $this->createCurlMock(200, json_encode(['status' => ['code' => 2000, 'message' => 'Authorized.'], 'data' => ['token' => $bearerToken = md5(uniqid() . time())]]));
        $serverConfig = $this->createAuthorizationServerMock();
        $arg = $this->createAuthorizationCommandArg();
        $command = new AuthorizationCommand($serverConfig, $curl);

        // Act
        $response = $command->handle($arg);

        // Assert
        $this->assertInstanceOf(AuthorizationResponse::class, $response);
        $this->assertEquals($response->getToken(), $bearerToken);
    }

    public function test_authorization_command_call_callback_function_if_authorization_is_successful()
    {

        // Initialize
        $curl = $this->createCurlMock(200, json_encode(['status' => ['code' => 2000, 'message' => 'Authorized.'], 'data' => ['token' => $bearerToken = md5(uniqid() . time())]]));
        $serverConfig = $this->createAuthorizationServerMock();
        $arg = $this->createAuthorizationCommandArg();
        $command = new AuthorizationCommand($serverConfig, $curl);

        /**
         * @var Callback&MockObject
         */
        $callback = $this->createMock(Callback::class);

        // Assert
        $callback->expects($this->once())
            ->method('__invoke')
            ->withAnyParameters()
            ->willReturn(null);

        // Act
        $command->handle($arg, $callback);
    }


    public function test_authorization_command_handle_works_with_tmoney_server()
    {
        // Initialize
        $serverConfig = $this->createAuthorizationServerMock(getenv('TM_HOST'), getenv('TM_TOKEN_URL'));
        $arg = $this->createAuthorizationCommandArg('POST', getenv('TM_USER'), getenv('TM_PASSWORD'));
        $command = new AuthorizationCommand($serverConfig);

        $result = $command->handle($arg);

        $this->assertInstanceOf(AuthorizationResponse::class, $result);
    }
}
