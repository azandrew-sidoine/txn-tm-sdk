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

use Drewlabs\Txn\Exceptions\RequestException;
use Drewlabs\Txn\TMoney\Traits\RequestClient;
use Drewlabs\Txn\TMoney\Contracts\TransactionServerOptionInterface;
use Drewlabs\Txn\TMoney\Contracts\CreditResultInterface;
use Drewlabs\Txn\TMoney\Contracts\TransactionStatusArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\CommandException;

final class CheckCreditStatusCommand
{

	use RequestClient;

	/**
	 * @var TransactionServerOptionInterface
	 */
	private $options = null;

	/**
	 * Create new class instance
	 * 
	 * @param TransactionServerOptionInterface $options
	 */
	public function __construct(TransactionServerOptionInterface $options)
	{
		# code...
		$this->options = $options;
	}

	/**
	 * Handle check credit status
	 * 
	 * @param TransactionStatusArgInterface $arg
	 *
	 * @return CreditResultInterface[]
	 */
	public function handle(TransactionStatusArgInterface $arg)
	{
		# code...
		$response = $this->sendRequest(
			sprintf("%s?%s", $this->options->getEndpoint(), (string)$arg),
			'GET',
			['Authorization' => sprintf("Bearer %s", $this->options->getBearerToken())]
		);

		if (2000 !== ($status = intval($response->getDecodedBodyValue('statut.code'))) && (200 !== $status)) {
			throw new CommandException(get_class($this), 500 === $response->getStatusCode() ? 'Internal Server Error' : 'Unknown error', $response->getStatusCode());
		}

		// Get the data from the decoded response body based on TMoney documentation
		$transactions = $response->getDecodedBodyValue('data') ?? [];

		// Map list of transactions into credit result instances
		return null === $transactions ? [] : array_map(function($transaction) {
			return new CreditResult($transaction);
		}, $transactions);
	}

	/**
	 * Get options property value
	 * 
	 *
	 * @return TransactionServerOptionInterface
	 */
	public function getOptions()
	{
		# code...
		return $this->options;
	}

}