<?php

namespace Drewlabs\Txn\TMoney\Tests\Stubs;

use Drewlabs\Txn\TMoney\Contracts\TransactionServerConfigInterface;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin TestCase
 */
trait TransactionServerConfigMockFactory
{

    public function createTransactionServerConfigMock(string $url = null, string $bearerToken = null)
    {
        /**
         * @var TransactionServerConfigInterface&MockObject
         */
        $server  = $this->createMock(TransactionServerConfigInterface::class);

        $server->method('getEndpoint')
            ->willReturn($url ?? 'http://127.0.0.1:8000/api/v1/transaction');

        $server->method('getBearerToken')
            ->willReturn($bearerToken ?? str_replace('=', '', str_replace([\chr(92), '+', \chr(47), \chr(38)], '.', base64_encode(openssl_random_pseudo_bytes(32)))));

        return $server;
    }
}
