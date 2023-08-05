<?php


namespace Drewlabs\Txn\TMoney\Tests\Stubs;

use Drewlabs\Txn\TMoney\Contracts\AuthorizationCommandArgInterface;
use PHPUnit\Framework\MockObject\IncompatibleReturnValueException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin TestCase
 */
trait AuthorizationCommandArgMockFactory
{

    /**
     * Creates an authorization command arg mock object
     * 
     * @param string|null $method 
     * @param string|null $user 
     * @param string|null $password 
     * @return AuthorizationCommandArgInterface&MockObject 
     * @throws IncompatibleReturnValueException 
     */
    public function createAuthorizationCommandArg(string $method = null, string $user = null, string $password = null)
    {
        /**
         * @var AuthorizationCommandArgInterface&MockObject
         */
        $command = $this->createMock(AuthorizationCommandArgInterface::class);

        $command->method('getAuthorizationMethod')
            ->willReturn($method ?? 'POST');

        $command->method('getAuthorizationId')
            ->willReturn($user ?? 'Client');

        $command->method('getAuthorizationSecret')
            ->willReturn($password ?? 'Password');

        return $command;
    }
}
