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

use DateTimeImmutable;
use Drewlabs\Txn\TMoney\Contracts\TransactionCommandArgInterface;

final class TransactionCommandArg implements TransactionCommandArgInterface
{

	/**
	 * @var string
	 */
	private $accountNumber = null;

	/**
	 * @var float
	 */
	private $amount = null;

	/**
	 * @var string
	 */
	private $reference = null;

	/**
	 * @var string
	 */
	private $command = null;

	/**
	 * @var string
	 */
	private $at = null;

	/**
	 * @var string
	 */
	private $description = null;

	/**
	 * Create new class instance
	 * 
	 * @param string $accountNumber
	 * @param float $amount
	 * @param string $reference
	 * @param string|null $command
	 * @param string|null $at
	 * @param string|null $description
	 */
	public function __construct(string $accountNumber, float $amount, string $reference, string $command = null, string $at = null, string $description = null)
	{
		# code...
		$this->accountNumber = $accountNumber;
		$this->amount = $amount;
		$this->reference = $reference;
		// TODO : Generate $command_id
		$this->command = $command;
		$this->at = $at ?? (new DateTimeImmutable())->format('Y-m-d H:i:s');
		$this->description = $description ?? sprintf("PAYMENT FACT. No. %s", strval($reference));
	}

	/**
	 * Returns the command id value
	 * 
	 *
	 * @return string
	 */
	public function getCommandId()
	{
		# code...
		return $this->command;
	}

	/**
	 * Returns account number for the transaction
	 * 
	 *
	 * @return string
	 */
	public function getAccountNumber()
	{
		# code...
		return $this->accountNumber;
	}

	/**
	 * Returns the transaction amount
	 * 
	 *
	 * @return string
	 */
	public function getAmount()
	{
		# code...
		return $this->amount;
	}

	/**
	 * Returns the transaction invoice reference
	 * 
	 *
	 * @return string
	 */
	public function getReference()
	{
		# code...
		return $this->reference;
	}

	/**
	 * Returns date at which the transaction was created
	 * 
	 *
	 * @return string|null
	 */
	public function getCreatedAt()
	{
		# code...
		return $this->at;
	}

	/**
	 * Returns transaction description
	 * 
	 *
	 * @return string|null
	 */
	public function getDescription()
	{
		# code...
		return $this->description;
	}

	/**
	 * Set accountNumber property value
	 * 
	 * @param string $value
	 *
	 * @return self
	 */
	public function setAccountNumber(string $value)
	{
		# code...
		$this->accountNumber = $value;
		return $this;
	}

	/**
	 * Set amount property value
	 * 
	 * @param float $value
	 *
	 * @return self
	 */
	public function setAmount(float $value)
	{
		# code...
		$this->amount = $value;
		return $this;
	}

	/**
	 * Set reference property value
	 * 
	 * @param string $value
	 *
	 * @return self
	 */
	public function setReference(string $value)
	{
		# code...
		$this->reference = $value;
		return $this;
	}

	/**
	 * Set command property value
	 * 
	 * @param string $value
	 *
	 * @return self
	 */
	public function setCommand(string $value)
	{
		# code...
		$this->command = $value;
		return $this;
	}

	/**
	 * Set at property value
	 * 
	 * @param string $value
	 *
	 * @return self
	 */
	public function setAt(string $value)
	{
		# code...
		$this->at = $value;
		return $this;
	}

	/**
	 * Set description property value
	 * 
	 * @param string $value
	 *
	 * @return self
	 */
	public function setDescription(string $value)
	{
		# code...
		$this->description = $value;
		return $this;
	}

}