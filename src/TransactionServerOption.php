<?php

declare(strict_types=1);

/*
 * This file is auto generated using the drewlabs/mdl UML model class generator package
 *
 * (c) Sidoine Azandrew <contact@liksoft.tg>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
*/

namespace Drewlabs\Txn\TMoney;

use Drewlabs\Txn\TMoney\Contracts\TransactionServerOptionInterface;

final class TransactionServerOption implements TransactionServerOptionInterface
{

	/**
	 * @var string
	 */
	private $url = null;

	/**
	 * @var string
	 */
	private $bearerToken = null;

	/**
	 * Create new class instance
	 * 
	 * @param string $url
	 * @param string $bearerToken
	 */
	public function __construct(string $url, string $bearerToken)
	{
		# code...
		$this->url = $url;
		$this->bearerToken = $bearerToken;
	}

	/**
	 * Returns the array representation of the server options
	 * 
	 *
	 * @return array
	 */
	public function toArray()
	{
		# code...
	}

	/**
	 * Return the transaction service endpoint value
	 * 
	 *
	 * @return string
	 */
	public function getEndpoint()
	{
		# code...
		return $this->url;
	}

	/**
	 * Return the bearer authorization header token string
	 * 
	 *
	 * @return string
	 */
	public function getBearerToken()
	{
		# code...
		return $this->bearerToken;
	}

}