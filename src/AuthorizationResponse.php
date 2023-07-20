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

use Drewlabs\Txn\TMoney\Contracts\AuthorizationResponseInterface;

final class AuthorizationResponse implements AuthorizationResponseInterface
{

	/**
	 * @var array
	 */
	private $attributes = [];

	/**
	 * 
	 * @var int
	 */
	private $status;

	/**
	 * Create new class instance
	 * 
	 * @param array $attributes
	 * @param int $status
	 */
	public function __construct(array $attributes, int $status = 200)
	{
		# code...
		$this->attributes = $attributes;
		$this->status = $status;
	}

	/**
	 * creates new class instance
	 * 
	 *
	 * @return static
	 */
	public static function new(array $attributes)
	{
		# code...
		return new static($attributes);
	}

	/**
	 * Returns the response status code
	 * 
	 *
	 * @return int
	 */
	public function getStatusCode()
	{
		# code...
		return $this->status;
	}

	/**
	 * Returns the authorization token string
	 * 
	 *
	 * @return string
	 */
	public function getToken()
	{
		# code...
		return $this->attributes['token'] ?? null;
	}

}