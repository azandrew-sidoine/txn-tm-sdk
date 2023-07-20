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

use Drewlabs\Txn\TMoney\Contracts\AuthorizationCommandArgInterface;

final class AuthorizationCommandArg implements AuthorizationCommandArgInterface
{

	/**
	 * @var string
	 */
	private $user = null;

	/**
	 * @var string
	 */
	private $pass = null;

	/**
	 * @var string
	 */
	private $method = 'POST';

	/**
	 * Create new class instance
	 * 
	 * @param string $user
	 * @param string $pass
	 * @param string $method
	 */
	public function __construct(string $user, string $pass, string $method = "POST")
	{
		# code...
		$this->user = $user;
		$this->pass = $pass;
		$this->method = $method;
	}

	/**
	 * Returns the authorization request method
	 * 
	 *
	 * @return string
	 */
	public function getAuthorizationMethod()
	{
		# code...
		return $this->method ?? 'POST';
	}

	/**
	 * Returns the authorization request client id or username
	 * 
	 *
	 * @return string
	 */
	public function getAuthorizationId()
	{
		# code...
		return $this->user;
	}

	/**
	 * Returns the authorization request client secret or password
	 * 
	 *
	 * @return string
	 */
	public function getAuthorizationSecret()
	{
		# code...
		return $this->pass;
	}

}