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

use DateTimeInterface;

interface TMoneyTransactionInterface
{

	/**
	 * Returns the TMoney platform transaction reference
	 * 
	 *
	 * @return string
	 */
	public function getTMoneyReference();

	/**
	 * Returns the date time at which transaction was processed
	 * 
	 *
	 * @return DateTimeInterface
	 */
	public function getProcessedAt();

	/**
	 * Returns TMOney request type
	 * 
	 *
	 * @return string
	 */
	public function getRequestType();

	/**
	 * Returns transaction reference
	 * 
	 *
	 * @return string
	 */
	public function getReference();

	/**
	 * Returns transaction value/amount
	 * 
	 *
	 * @return float
	 */
	public function getValue();

	/**
	 * Returns transaction payeer identity / phone number
	 * 
	 *
	 * @return string
	 */
	public function getPayeer();

	/**
	 * Returns transaction merchant which wallet was affected by the transaction
	 * 
	 *
	 * @return string
	 */
	public function getMerchant();

}