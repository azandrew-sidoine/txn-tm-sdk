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
use Drewlabs\Txn\TMoney\Contracts\CreditResultInterface;
use Drewlabs\Txn\TMoney\Contracts\TransactionCommandArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\CreditRequestException;

final class CreditCommand
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
			$this->options->getEndpoint(),
			'POST',
			["idRequete" => $arg->getCommandId(), "numeroClient" => $arg->getAccountNumber(), "montant" => $arg->getAmount(), "refCommande" => $arg->getReference(), "dateHeureRequete" => $arg->getCreatedAt(), "description" => $arg->getDescription()],
			['Authorization' => sprintf("Bearer %s", $this->options->getBearerToken())]
		);

		if (2000 !== ($status = intval($response->getDecodedBodyValue('statut.code'))) && (200 !== $status)) {
			throw new CreditRequestException($response->getDecodedBodyValue('message', 'Unknown Error'), $status);
		}

		return new CreditResult($response->getDecodedBody());
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
