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
use Drewlabs\Txn\TMoney\Contracts\AuthorizationServerConfigInterface;
use Drewlabs\Txn\TMoney\Contracts\AuthorizationResponseInterface;
use Drewlabs\Txn\TMoney\Contracts\AuthorizationCommandArgInterface;
use Drewlabs\Txn\TMoney\Exceptions\AuthorizationException;
use Drewlabs\Curl\Client as Curl;

final class AuthorizationCommand
{

	use RequestClient;

	/**
	 * @var AuthorizationServerConfigInterface
	 */
	private $server = null;

	/**
	 * Create new class instance
	 * 
	 * @param AuthorizationServerConfigInterface $server
	 */
	public function __construct(AuthorizationServerConfigInterface $server, Curl $curl = null)
	{
		# code...
		$this->server = $server;
		$this->curl = $curl ?? new Curl();
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

		$status = intval($response->getDecodedBodyValue('status.code', function() use ($response) {
			// Added a fallback to statut.code case the status.code does not exists
			return $response->getDecodedBodyValue('statut.code');
		}));
	
		if (2000 !== $status) {
			// We throw an authorization exception case the response status does not equals 2000 or 200
			throw new AuthorizationException($response->getDecodedBodyValue('status.description', function () use ($response) {
				return $response->getDecodedBodyValue('status.message') ?? 'UnAuthorized.';
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
	 * @return AuthorizationServerConfigInterface
	 */
	public function getServer()
	{
		# code...
		return $this->server;
	}
}
