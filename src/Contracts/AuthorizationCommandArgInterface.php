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

namespace Drewlabs\Txn\TMoney\Contracts;


interface AuthorizationCommandArgInterface
{

	/**
	 * Returns the authorization request method
	 * 
	 *
	 * @return string
	 */
	public function getAuthorizationMethod();

	/**
	 * Returns the authorization request client id or username
	 * 
	 *
	 * @return string
	 */
	public function getAuthorizationId();

	/**
	 * Returns the authorization request client secret or password
	 * 
	 *
	 * @return string
	 */
	public function getAuthorizationSecret();

}