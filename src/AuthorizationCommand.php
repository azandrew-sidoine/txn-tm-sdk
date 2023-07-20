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
use Drewlabs\Txn\TMoney\Contracts\AuthorizationServerInterface;
use Drewlabs\Txn\TMoney\Contracts\AuthorizationResponseInterface;
use Drewlabs\Txn\TMoney\Contracts\AuthorizationCommandArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\AuthorizationException;

final class AuthorizationCommand
{

	use RequestClient;

	/**
	 * @var AuthorizationServerInterface
	 */
	private $server = null;

	/**
	 * Create new class instance
	 * 
	 * @param AuthorizationServerInterface $server
	 */
	public function __construct(AuthorizationServerInterface $server)
	{
		# code...
		$this->server = $server;
	}

	/**
	 * Handle authorize request
	 * 
	 * @param AuthorizationCommandArgInterface $arg
	 * 
	 * @return AuthorizationResponseInterface|mixed
	 *
	 */
	public function handle(AuthorizationCommandArgInterface $arg, callable $callback = null)
	{
		$callback = $callback ?? function(AuthorizationResponseInterface $response) {
			return $response;
		};
		# code...
		$response = $this->sendRequest($this->server->getTokenUrl(), $arg->getAuthorizationMethod() ?? 'POST', [
			"nomUtilisateur" => $arg->getAuthorizationId(),
			"motDePasse" => $arg->getAuthorizationSecret()
		]);

		if (2000 !== ($status = intval($response->getDecodedBodyValue('statut.code'))) && (200 !== $status)) {
			// We throw an authorization exception case the response status does not equals 2000 or 200
			throw new AuthorizationException($response->getDecodedBodyValue('status.description', function () use ($response) {
				return $response->getDecodedBody('status.message') ?? 'UnAuthorized.';
			}), $status);
		}
		$authResponse = new AuthorizationResponse($response->getDecodedBodyValue('data'), $status ?? $response->getStatusCode());

		// Returns the result of the callback call
		return call_user_func($callback, $authResponse);
	}

	/**
	 * Get server property value
	 * 
	 *
	 * @return AuthorizationServerInterface
	 */
	public function getServer()
	{
		# code...
		return $this->server;
	}
}
