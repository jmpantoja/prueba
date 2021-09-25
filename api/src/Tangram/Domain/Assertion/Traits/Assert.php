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

namespace Tangram\Domain\Assertion\Traits;

use Tangram\Domain\Assertion\Assertion;

trait Assert
{
	private function assert($value)
	{
		return Assertion::make(__CLASS__)
			->assert($value);
	}
}
