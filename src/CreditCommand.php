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
use Drewlabs\Txn\TMoney\Contracts\TransactionCommandArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\CommandException;
use Drewlabs\Curl\Client as Curl;

final class CreditCommand
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
	 * Handle credit request
	 * 
	 * @param TransactionCommandArgInterface $arg
	 *
	 * @return CreditResultInterface
	 */
	public function handle(TransactionCommandArgInterface $arg)
	{
		# code...
		$response = $this->sendRequest(
			$this->config->getEndpoint(),
			'POST',
			["idRequete" => $arg->getCommandId(), "numeroClient" => $arg->getAccountNumber(), "montant" => $arg->getAmount(), "refCommande" => $arg->getReference(), "dateHeureRequete" => $arg->getCreatedAt(), "description" => $arg->getDescription()],
			['Authorization' => sprintf("Bearer %s", $this->config->getBearerToken())]
		);

		if (2000 !== ($status = intval($response->getDecodedBodyValue('code'))) && (200 !== $status) && (2001 !== $status)) {
			throw new CommandException(get_class($this), $response->getDecodedBodyValue('message', 'Unknown Error'), $status);
		}

		return new CreditTransaction($response->getDecodedBody());
	}

	/**
	 * Get options property value
	 * 
	 *
	 * @return ContractsTransactionServerOptionInterface
	 */
	public function getConfig()
	{
		# code...
		return $this->config;
	}
}
