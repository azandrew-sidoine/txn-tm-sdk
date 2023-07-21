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

namespace Drewlabs\Txn\TMoney\Contracts;


interface CommandErrorInterface
{

	/**
	 * Return command error code
	 * 
	 *
	 * @return int
	 */
	public function getErrorCode();

	/**
	 * Return command error reason phrase
	 * 
	 *
	 * @return string
	 */
	public function getErrorMessage();

	/**
	 * Returns the command name for which the error is generated
	 * 
	 *
	 * @return string
	 */
	public function getCommand();

}