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


interface AuthorizationServerInterface
{

	/**
	 * Returns the authorization server host
	 * 
	 *
	 * @return string
	 */
	public function getHost();

	/**
	 * Returns the authorization server token request url
	 * 
	 *
	 * @return string
	 */
	public function getTokenUrl();

}