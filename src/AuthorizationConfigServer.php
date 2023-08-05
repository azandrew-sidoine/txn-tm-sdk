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

use Drewlabs\Txn\TMoney\Contracts\AuthorizationServerConfigInterface;

final class AuthorizationConfigServer implements AuthorizationServerConfigInterface
{
	/**
	 * @var string
	 */
	private $host = null;

	/**
	 * @var string
	 */
	private $tokenPath = null;

	/**
	 * Create new class instance
	 * 
	 * @param string $host
	 * @param string $tokenPath
	 */
	public function __construct(string $host, string $tokenPath)
	{
		# code...
		$this->host = $host;
		$this->tokenPath = $tokenPath;
	}

	/**
	 * Returns the authorization server host
	 * 
	 *
	 * @return string
	 */
	public function getHost()
	{
		# code...
		return $this->host;
	}

	/**
	 * Returns the authorization server token request url
	 * 
	 *
	 * @return string
	 */
	public function getTokenUrl()
	{
		# code...
		$tokenHost = parse_url($this->tokenPath ?? '', PHP_URL_HOST);
		if ($tokenHost) {
			return $this->tokenPath;
		}
		$host = rtrim($this->host ?? '', '/');
		return sprintf("%s/%s", $host, ltrim($this->tokenPath, '/'));
	}

}