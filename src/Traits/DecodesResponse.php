<?php

declare(strict_types=1);

/*
 * This file is part of the drewlabs namespace.
 *
 * (c) Sidoine Azandrew <azandrewdevelopper@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Drewlabs\Txn\TMoney\Traits;

use Drewlabs\Curl\Converters\JSONDecoder;
use Drewlabs\Txn\TMoney\RegExp;

trait DecodesResponse
{

    /**
     * Decode request response.
     *
     * @throws JsonException
     *
     * @return array
     */
    private function decodeResponse(string $response)
    {
        $result = null;
        if (RegExp::matchJson($this->getHeader('content-type', 'application/json'))) {
            $result = (new JSONDecoder(true))->decode($response);
        }
        // If the Content-Type header is not present in the response headers, we apply the try catch clause
        // To insure no error is thrown when decoding.
        if (null === $result) {
            try {
                $result = (new JSONDecoder(true))->decode($response) ?? [];
            } catch (\Throwable $e) {
                $result = [];
            }
        }

        return (array) ($result ?? []);
    }
}