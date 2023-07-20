<?php

declare(strict_types=1);

namespace Drewlabs\Txn\TMoney;

use Drewlabs\Txn\TMoney\Traits\DecodesResponse;

class Response
{
    use DecodesResponse;

    /**
     * @var string
     */
    private $body = null;

    /**
     * 
     * @var array<string,mixed>
     */
    private $decodedBody = [];

    /**
     * 
     * @var array<string,mixed>
     */
    private $headers = [];

    /**
     * 
     * @var int
     */
    private $status;

    /**
     * Creates response instance
     * 
     * @param string $body 
     * @param int $status 
     * @param array $headers 
     * @return void 
     */
    public function __construct($body = '', int $status = 200, array $headers = [])
    {
        $this->body = $body;
        if (!empty($body)) {
            $this->decodedBody = $this->decodeResponse($body, $headers ?? []);
        }
        $this->headers = $headers;
        $this->status = $status;
    }

    /**
     * returns the response status code
     * 
     * @return int 
     */
    public function getStatusCode()
    {
        return $this->status;
    }


    /**
     * returns the list of response headers
     * 
     * @return array 
     */
    public function getHeaders()
    {
        return $this->headers ?? [];
    }

    /**
     * returns the header value for the $name attribute
     * 
     * @param string $name 
     * @param mixed $default 
     * @return string 
     */
    public function getHeader(string $name, $default = null)
    {
        return $this->getHeaders()[$name] ?? (!is_string($default) && is_callable($default) ? $default() : $default ?? null);
    }

    /**
     * returns the decoded body value
     * 
     * @return array<string, mixed> 
     */
    public function getDecodedBody()
    {
        return $this->decodedBody ?? [];
    }

    /**
     * returns the raw response string body
     * 
     * @return string 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * return value for a given attribute in the decoded response body
     * 
     * @param string $name 
     * @param mixed $default 
     * @return mixed 
     */
    public function getDecodedBodyValue(string $name, $default = null)
    {
        # code...
        if (false !== strpos($name, '.')) {
            $keys = explode('.', $name);
            $count = count($keys);
            $index = 0;
            $current = $this->getDecodedBody();
            while ($index < $count) {
                # code...
                if (null === $current) {
                    return (!is_string($default) && is_callable($default) ? $default() : $default ?? null);
                }
                $current = array_key_exists($keys[$index], $current) ? $current[$keys[$index]] : $current[$keys[$index]] ?? null;
                $index += 1;
            }
            return $current;
        }
        return $this->getDecodedBody()[$name] ?? (!is_string($default) && is_callable($default) ? $default() : $default ?? null);
    }
}
