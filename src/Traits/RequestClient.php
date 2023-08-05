<?php

declare(strict_types=1);

namespace Drewlabs\Txn\TMoney\Traits;

use Drewlabs\Txn\Exceptions\RequestException;
use Drewlabs\Curl\Client as Curl;
use Drewlabs\Txn\TMoney\Response;

trait RequestClient
{
    /**
     * @var Curl
     */
    private $curl;

    /**
     * Send request to the backend server and return the result to the caller
     * 
     * @param string $endpoint 
     * @param string $method 
     * @param array $body 
     * @param array $headers 
     * @return Response 
     * @throws RuntimeException 
     * @throws RequestException 
     */
    private function sendRequest(string $endpoint, string $method = 'GET', array $body = [], array $headers = []): Response
    {
        $this->resetCurl();

        // Sends the request to the coris webservice host
        $this->curl->send([
            'method' => $method,
            'url' => $endpoint,
            'headers' => array_merge([
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ], $headers ?? []),
            'body' => $body
        ]);
        
        if (200 !== ($statusCode = $this->curl->getStatusCode())) {
            throw new RequestException("/GET $endpoint : Unknown Request error", $statusCode);
        }

        // TODO: Return a response instance
        return new Response($this->curl->getResponse() ?? '', intval($statusCode), $this->parseHeaders($this->curl->getResponseHeaders()));
    }

    /**
     * Reset the curl client to it default options.
     *
     * @return void
     */
    private function resetCurl()
    {
        // First we release the current client resources
        $this->curl->release();
        $this->curl->init();
        // Disable ssl verification to avoid any SSL error
        $this->curl->disableSSLVerification();
        $this->curl->setOption(\CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Parse request string headers.
     *
     * @param string $headers
     *
     * @return array
     */
    private function parseHeaders($headers)
    {
        $headers = preg_split('/\r\n/', (string) ($headers ?? ''), -1, \PREG_SPLIT_NO_EMPTY);
        $httpHeaders = [];
        $httpHeaders['Request-Line'] = reset($headers) ?? '';
        for ($i = 1; $i < \count($headers); ++$i) {
            if (str_contains($headers[$i], ':')) {
                [$key, $value] = array_map(static function ($item) {
                    return $item ? trim($item) : null;
                }, explode(':', $headers[$i], 2));
                $httpHeaders[$key] = $value;
            }
        }

        return $httpHeaders;
    }
}
