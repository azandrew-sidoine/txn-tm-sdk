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

use Drewlabs\Txn\TMoney\Traits\RequestClient;
use Drewlabs\Txn\TMoney\Contracts\TransactionServerOptionInterface;
use Drewlabs\Txn\TMoney\Contracts\TransactionServerOptionInterface as ContractsTransactionServerOptionInterface;
use Drewlabs\Txn\TMoney\Contracts\DebitResultInterface;
use Drewlabs\Txn\TMoney\Contracts\TransactionCommandArgInterface;

final class DebitCommand
{

	use RequestClient;

	/**
	 * @var TransactionServerOptionInterface
	 */
	private $options = null;

	/**
	 * Create new class instance
	 * 
	 * @param ContractsTransactionServerOptionInterface $options
	 */
	public function __construct(ContractsTransactionServerOptionInterface $options)
	{
		# code...
		$this->options = $options;
	}

	/**
	 * Handle debit request
	 * 
	 * @param TransactionCommandArgInterface $arg
	 *
	 * @return DebitResultInterface
	 */
	public function handle(TransactionCommandArgInterface $arg)
	{
		# code...
	}

	/**
	 * Get options property value
	 * 
	 *
	 * @return ContractsTransactionServerOptionInterface
	 */
	public function getOptions()
	{
		# code...
		return $this->options;
	}

}