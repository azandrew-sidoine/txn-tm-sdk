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


interface DebitInterface extends TMoneyTransactionInterface, CommandResultInterface
{

	/**
	 * Return the credit operation result description
	 * 
	 *
	 * @return string
	 */
	public function getDescription();

	/**
	 * Return the credit operation result code
	 * 
	 *
	 * @return int
	 */
	public function getCode();

	/**
	 * Return the credit operation result reason phrase
	 * 
	 *
	 * @return string
	 */
	public function getReasonPhrase();

}