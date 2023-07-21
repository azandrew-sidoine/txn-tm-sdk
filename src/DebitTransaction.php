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

use Drewlabs\Txn\TMoney\Contracts\TMoneyTransactionInterface;
use Drewlabs\Txn\TMoney\Contracts\CommandResultInterface;
use DateTimeInterface;

final class DebitTransaction implements TMoneyTransactionInterface, CommandResultInterface
{

	/**
	 * @var array
	 */
	private $attributes = null;

	/**
	 * Create new class instance
	 * 
	 * @param array $attributes
	 */
	public function __construct(array $attributes)
	{
		# code...
		$this->attributes = $attributes;
	}

	/**
	 * Returns the TMoney platform transaction reference
	 * 
	 *
	 * @return string
	 */
	public function getTMoneyReference()
	{
		# code...
		return $this->attributes['refTmoney']  ?? null;
	}

	/**
	 * Returns the date time at which transaction was processed
	 * 
	 *
	 * @return DateTimeInterface
	 */
	public function getProcessedAt()
	{
		# code...
		$at = $this->attributes['dateHeureTmoney'] ?? null;
		return $at !== null ? \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $at) : $at;
	}

	/**
	 * Returns TMOney request type
	 * 
	 *
	 * @return string
	 */
	public function getRequestType()
	{
		# code...
		return $this->attributes['typeRequete'] ?? null;
	}

	/**
	 * Returns transaction reference
	 * 
	 *
	 * @return string
	 */
	public function getReference()
	{
		# code...
		return $this->attributes['refCommande'] ?? null;
	}

	/**
	 * Returns transaction value/amount
	 * 
	 *
	 * @return float
	 */
	public function getValue()
	{
		# code...
		return $this->attributes['montant'] ?? null;
	}

	/**
	 * Returns transaction payeer identity / phone number
	 * 
	 *
	 * @return string
	 */
	public function getPayeer()
	{
		# code...
		$this->attributes['numeroClient'] ?? null;
	}

	/**
	 * Returns transaction merchant which wallet was affected by the transaction
	 * 
	 *
	 * @return string
	 */
	public function getMerchant()
	{
		# code...
		return $this->attributes['nomPartenaire'] ?? null;
	}

	/**
	 * Return command result code
	 * 
	 *
	 * @return int
	 */
	public function getCode()
	{
		# code...
		return $this->attributes['code'] ?? 5000;
	}

	/**
	 * Return command result reason phrase
	 * 
	 *
	 * @return string
	 */
	public function getReasonPhrase()
	{
		# code...
		return $this->attributes['description'] ??  $this->attributes['message'] ?? null;
	}

	/**
	 * Return command command id for which the result is generated
	 * 
	 *
	 * @return string
	 */
	public function getCommandId()
	{
		# code...
		return $this->attributes['idRequete'] ?? null;
	}

	/**
	 * Get attributes property value
	 * 
	 *
	 * @return array
	 */
	public function getAttributes()
	{
		# code...
		return $this->attributes;
	}

}