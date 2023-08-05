<?php

namespace Drewlabs\Txn\TMoney\Tests\Stubs;

use Drewlabs\Txn\TMoney\Contracts\AuthorizationServerConfigInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin TestCase
 */
trait AuthorizationServerMockFactory
{

    public function createAuthorizationServerMock(string $host = null, string $tokenUrl = null)
    {
        /**
         * @var AuthorizationServerConfigInterface&MockObject
         */
        $server  = $this->createMock(AuthorizationServerConfigInterface::class);

        $server->method('getHost')
            ->willReturn($host ?? 'http://127.0.0.1');

        $server->method('getTokenUrl')
            ->willReturn($tokenUrl ?? 'http://127.0.0.1:8000/api/oauth/token');

        return $server;
    }
}
