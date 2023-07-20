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


interface TransactionServerOptionInterface
{

	/**
	 * Return the transaction service endpoint value
	 * 
	 *
	 * @return string
	 */
	public function getEndpoint();

	/**
	 * Return the bearer authorization header token string
	 * 
	 *
	 * @return string
	 */
	public function getBearerToken();

}