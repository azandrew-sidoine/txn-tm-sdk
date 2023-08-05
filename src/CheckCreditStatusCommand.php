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
use Drewlabs\Txn\TMoney\Contracts\TransactionServerConfigInterface;
use Drewlabs\Txn\TMoney\Contracts\CreditResultInterface;
use Drewlabs\Txn\TMoney\Contracts\TransactionStatusArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\CommandException;
use Drewlabs\Curl\Client as Curl;

final class CheckCreditStatusCommand
{

	use RequestClient;

	/**
	 * @var TransactionServerConfigInterface
	 */
	private $config = null;

	/**
	 * Create new class instance
	 * 
	 * @param TransactionServerConfigInterface $config
	 */
	public function __construct(TransactionServerConfigInterface $config, Curl $curl = null)
	{
		# code...
		$this->config = $config;
		$this->curl = $curl ?? new Curl();
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
			sprintf("%s?%s", $this->config->getEndpoint(), (string)$arg),
			'GET',
			['Authorization' => sprintf("Bearer %s", $this->config->getBearerToken())]
		);

		if (($status = intval($response->getStatusCode())) && (200 !== $status)) {
			throw new CommandException(get_class($this), 500 === $response->getStatusCode() ? 'Internal Server Error' : 'Unknown error', $response->getStatusCode());
		}

		// Get the data from the decoded response body based on TMoney documentation
		$transactions = $response->getDecodedBodyValue('data') ?? [];

		// Map list of transactions into credit result instances
		return null === $transactions ? [] : array_map(function($transaction) {
			return new CreditTransaction($transaction);
		}, $transactions);
	}

	/**
	 * Get options property value
	 * 
	 *
	 * @return TransactionServerConfigInterface
	 */
	public function getOptions()
	{
		# code...
		return $this->config;
	}

}