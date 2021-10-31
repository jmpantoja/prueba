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

use RuntimeException;

final class ConstraintNotFound extends RuntimeException
{
	public function __construct(array $candidates)
	{
		$message = sprintf('No existe ninguna constraint válida (%s)', implode(' | ', $candidates));
		parent::__construct($message);
	}
}
