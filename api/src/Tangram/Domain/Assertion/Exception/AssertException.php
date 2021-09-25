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

namespace Tangram\Domain\Assertion\Exception;

use InvalidArgumentException;
use Symfony\Component\Validator\ConstraintViolationList;

final class AssertException extends InvalidArgumentException
{
	private ConstraintViolationList $violationList;

	public function __construct(ConstraintViolationList $violationList)
	{
		$this->violationList = $violationList;
		parent::__construct($this->joinMessages());
	}

	public function joinMessages(string $separator = "\n")
	{
		return implode($separator, $this->getMessages());
	}

	public function getMessages(): array
	{
		$messages = [];
		foreach ($this->violationList as $name => $violation) {
			$messages[$name] = sprintf('%s %s', ...[
				$violation->getPropertyPath(),
				$violation->getMessage(),
			]);
		}

		return $messages;
	}
}
