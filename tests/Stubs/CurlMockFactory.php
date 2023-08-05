<?php

namespace Drewlabs\Txn\TMoney\Tests\Stubs;

use Drewlabs\Curl\Client as Curl;
use PHPUnit\Framework\MockObject\IncompatibleReturnValueException;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @mixin TestCase
 */
trait CurlMockFactory
{
    /**
     * Creates a curl client mock object
     * 
     * @param int $status 
     * @param string $response 
     * @param string $headers 
     * @return MockObject&Curl 
     * @throws IncompatibleReturnValueException 
     */
    public function createCurlMock(int $status = 200, string $response = '', string $headers = '')
    {
        $defaultHeaders = "Connection: close\r\nX-Powered-By: W3 Total Cache/0.8\r\nPragma: public\r\nExpires: Sat, 28 Nov 2009 05:36:25 GMT\r\n Cache-Control: max-age=3600, public\r\nContent-Type: text/html; charset=UTF-8\r\nLast-Modified: Sat, 28 Nov 2009 03:50:37 GMT\r\nContent-Encoding: gzip\r\nVary: Accept-Encoding, Cookie, User-Agent";
        /**
         * @var MockObject&Curl
         */
        $curl = $this->createMock(Curl::class);

        // Mock getStatusCode method
        $curl->method('getStatusCode')
            ->willReturn($status);

        $curl->method('getResponse')
            ->willReturn($response);

        $curl->method('getResponseHeaders')
            ->willReturn(empty($headers) ? $defaultHeaders : $headers);

        return $curl;
    }
}
