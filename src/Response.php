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
    public function __construct(string $body = '', int $status = 200, array $headers = [])
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
        $default = !is_string($default) && is_callable($default) ? $default() : function () use ($default) {
            return $default ?? null;
        };
        if (empty($headers = $this->getHeaders())) {
            return $default();
        }
        $normalized = strtolower($name);
        foreach ($headers as $key => $header) {
            if (strtolower($key) === $normalized) {
                return implode(',', \is_array($header) ? $header : [$header]);
            }
        }
        return $default();
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

    /**
     * clone the current instance to a new response instance
     * 
     * @return static 
     */
    public function clone()
    {
        return new static($this->getBody() ?? '', $this->getStatusCode(), $this->getHeaders());
    }

    /**
     * immutable interface that modifies the response body instance
     * 
     * @param string $body 
     * @return static 
     */
    public function withBody(string $body)
    {
        return new static($body, $this->getStatusCode(), $this->getHeaders());
    }

    /**
     * immutable interface that modifies the headers property of the response
     * 
     * @param array $headers 
     * @return static 
     */
    public function withHeaders(array $headers)
    {
        return new static($this->getBody(), $this->getStatusCode(), $headers);
    }

    /**
     * immutable interface adding header value to response headers
     * 
     * @param string $name 
     * @param mixed $value 
     * @return static 
     */
    public function withAddedHeader(string $name, $value)
    {
        $headers = $this->getHeaders();
        if (array_key_exists($name, $headers) && is_array($headers[$name])) {
            $headers[$name][] = $value;
        } else {
            $headers[$name] = !empty($headers[$name]) ? array_merge([$headers[$name]], [$value]) : $value;
        }
        return $this->withHeaders($headers);
    }
}
