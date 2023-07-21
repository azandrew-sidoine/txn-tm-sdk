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
use Drewlabs\Txn\TMoney\Contracts\DebitInterface;
use Drewlabs\Txn\TMoney\Contracts\TransactionStatusArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\CommandException;
use Drewlabs\Curl\Client as Curl;

final class CheckDebitStatusCommand
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
	public function __construct(ContractsTransactionServerOptionInterface $options, Curl $curl = null)
	{
		# code...
		$this->options = $options;
		$this->curl = $curl ?? new Curl();
	}

	/**
	 * Handle check debit status
	 * 
	 * @param TransactionStatusArgInterface $arg
	 *
	 * @return DebitInterface
	 */
	public function handle(TransactionStatusArgInterface $arg)
	{
		# code...
		$response = $this->sendRequest(
			sprintf("%s?%s", $this->options->getEndpoint(), (string)$arg),
			'GET',
			['Authorization' => sprintf("Bearer %s", $this->options->getBearerToken())]
		);

		if (($status = intval($response->getStatusCode())) && (200 !== $status)) {
			throw new CommandException(get_class($this), 500 === $response->getStatusCode() ? 'Internal Server Error' : 'Unknown error', $response->getStatusCode());
		}

		// Get the data from the decoded response body based on TMoney documentation
		$transactions = $response->getDecodedBodyValue('data') ?? [];

		// Map list of transactions into debit result instances
		return null === $transactions ? [] : array_map(function($transaction) {
			return new DebitTransaction($transaction);
		}, $transactions);
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