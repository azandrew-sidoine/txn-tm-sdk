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
use Drewlabs\Txn\TMoney\Contracts\TransactionServerConfigInterface as ContractsTransactionServerOptionInterface;
use Drewlabs\Txn\TMoney\Contracts\CommandResultInterface;
use Drewlabs\Txn\TMoney\Contracts\TransactionCommandArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\CommandException;
use Drewlabs\Curl\Client as Curl;

final class DebitCommand
{

	use RequestClient;

	/**
	 * @var TransactionServerConfigInterface
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
	 * Handle debit request
	 * 
	 * @param TransactionCommandArgInterface $arg
	 *
	 * @return CommandResultInterface
	 */
	public function handle(TransactionCommandArgInterface $arg)
	{
		# code...
		$response = $this->sendRequest(
			$this->options->getEndpoint(),
			'POST',
			["idRequete" => $arg->getCommandId(), "numeroClient" => $arg->getAccountNumber(), "montant" => $arg->getAmount(), "refCommande" => $arg->getReference(), "dateHeureRequete" => $arg->getCreatedAt(), "description" => $arg->getDescription()],
			['Authorization' => sprintf("Bearer %s", $this->options->getBearerToken())]
		);

		if (2000 !== ($status = intval($response->getDecodedBodyValue('code'))) && (200 !== $status)) {
			throw new CommandException(get_class($this), $response->getDecodedBodyValue('message', 'Unknown Error'), $status);
		}

		return new CommandResult(strval($arg->getCommandId()), $status, $response->getDecodedBodyValue('message') ?? 'Unknown command message');
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
