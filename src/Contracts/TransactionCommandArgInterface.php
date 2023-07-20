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


interface TransactionCommandArgInterface
{

	/**
	 * Returns the command id value
	 * 
	 *
	 * @return string
	 */
	public function getCommandId();

	/**
	 * Returns account number for the transaction
	 * 
	 *
	 * @return string
	 */
	public function getAccountNumber();

	/**
	 * Returns the transaction amount
	 * 
	 *
	 * @return string
	 */
	public function getAmount();

	/**
	 * Returns the transaction invoice reference
	 * 
	 *
	 * @return string
	 */
	public function getReference();

	/**
	 * Returns date at which the transaction was created
	 * 
	 *
	 * @return string|null
	 */
	public function getCreatedAt();

	/**
	 * Returns transaction description
	 * 
	 *
	 * @return string|null
	 */
	public function getDescription();

}