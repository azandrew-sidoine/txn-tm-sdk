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

use Drewlabs\Txn\TMoney\Contracts\TransactionStatusArgInterface;

final class TransactionStatusArg implements TransactionStatusArgInterface
{

	/**
	 * @var string
	 */
	private $value = null;

	/**
	 * Create new class instance
	 * 
	 * @param string $value
	 */
	public function __construct(string $value)
	{
		# code...
		$this->value = $value;
	}

	/**
	 * Returns the transaction command id
	 * 
	 *
	 * @return string
	 */
	public function __toString()
	{
		# code...
		return (string)($this->value);
	}

}