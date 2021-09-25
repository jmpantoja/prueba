<?php

/**
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tangram\Domain\Lists\Exception;

use PlanB\Edge\Domain\VarType\Exception\InvalidTypeException;
use RuntimeException;

class NonExistentElement extends RuntimeException
{
	/**
	 * InvalidTypeException constructor.
	 *
	 * @param mixed  $value
	 * @param string $expectedType
	 */
	public function __construct(string | int $key)
	{
		$message = sprintf("The element '%s' not exists in this collection", $key);
		parent::__construct($message);
	}
}
