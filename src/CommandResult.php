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

use Drewlabs\Txn\TMoney\Contracts\CommandResultInterface;

final class CommandResult implements CommandResultInterface
{

	/**
	 * @var string
	 */
	private $id = null;

	/**
	 * @var int
	 */
	private $code = null;

	/**
	 * @var string
	 */
	private $message = null;

	/**
	 * Create new class instance
	 * 
	 * @param string $id
	 * @param int $code
	 * @param string $message
	 */
	public function __construct(string $id, int $code, string $message)
	{
		# code...
		$this->id = $id;
		$this->code = $code;
		$this->message = $message;
	}

	/**
	 * Return command result code
	 * 
	 *
	 * @return int
	 */
	public function getCode()
	{
		# code...
		return $this->code;
	}

	/**
	 * Return command result reason phrase
	 * 
	 *
	 * @return string
	 */
	public function getReasonPhrase()
	{
		# code...
		return $this->message;
	}

	/**
	 * Return command command id for which the result is generated
	 * 
	 *
	 * @return string
	 */
	public function getCommandId()
	{
		# code...
		return $this->id;
	}

}