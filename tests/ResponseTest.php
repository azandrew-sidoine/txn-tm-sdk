<?php

use Drewlabs\Txn\TMoney\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{

    public function test_response_default_constructor()
    {
        // Initialize
        $response = new Response;

        // Assert
        $this->assertEquals([], $response->getHeaders());
        $this->assertEquals('', $response->getBody());
        $this->assertEquals(200, $response->getStatusCode());
    }

    public function test_response_from_json_string()
    {
        // Initialize
        $command = ['commandId' => sprintf('%s%s', time(), rand(100, 10000)), 'date' => date('Y-m-d H:i:s'), 'message' => 'Processing command...'];
        $response = new Response(json_encode($command));

        // Assert
        $this->assertEquals($command, $response->getDecodedBody());
    }

    public function test_response_get_decoded_body_value_return_value_corresponding_to_specified_key_or_default_or_null_if_no_default_is_provided()
    {
        // Initialize
        $command = ['commandId' => sprintf('%s%s', time(), rand(100, 10000)), 'date' => date('Y-m-d H:i:s'), 'message' => 'Processing command...'];
        $response = new Response(json_encode($command));


        // Assert
        $this->assertEquals($command['commandId'], $response->getDecodedBodyValue('commandId'));
        $this->assertEquals('Processing command...', $response->getDecodedBodyValue('message'));
    }

    public function test_response_get_header_return_header_value_if_exists_or_null_if_not()
    {
        // Initialize
        $response = new Response('', 201, ['Content-Type' => 'text/csv', 'Accept' => '*/*']);

        // Assert
        $this->assertEquals('text/csv', $response->getHeader('Content-Type'));
        $this->assertEquals(null, $response->getHeader('Origin'));
    }

    public function test_response_get_header_is_case_insensitive()
    {
        // Initialize
        $response = new Response('', 201, ['Content-Type' => 'text/csv', 'Accept' => '*/*']);

        // Assert
        $this->assertEquals('text/csv', $response->getHeader('content-type'));
    }

    public function test_response_with_headers_is_immutable_as_it_does_not_alter_original_response()
    {
        // Initialize
        $response = new Response('', 201, ['Content-Type' => 'text/csv']);

        // Act
        $response2 = $response->withHeaders(['Accept-Range' => 'bytes']);

        // Assert
        $this->assertNotEquals($response->getHeaders(), $response2->getHeaders());
        $this->assertEquals($response2->getHeaders(), ['Accept-Range' => 'bytes']);
        $this->assertEquals(['Content-Type' => 'text/csv'], $response->getHeaders());
    }

    public function test_response_with_added_header_is_immutable_as_it_does_not_alter_original_response()
    {
        // Initialize
        $response = new Response('', 201, ['Content-Type' => 'text/csv']);

        // Act
        $response2 = $response->withAddedHeader('Accept-Range', 'bytes');

        // Assert
        $this->assertNotEquals($response->getHeaders(), $response2->getHeaders());
        $this->assertEquals($response2->getHeaders(), ['Content-Type' => 'text/csv', 'Accept-Range' => 'bytes']);
        $this->assertEquals(['Content-Type' => 'text/csv'], $response->getHeaders());
    }
}