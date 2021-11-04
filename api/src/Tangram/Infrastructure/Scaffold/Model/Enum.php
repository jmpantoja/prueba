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

namespace Tangram\Infrastructure\Scaffold\Model;

final class Enum extends Model
{
	public function configure(ModelOptions $options): void
	{
		$options->withConstants();
	}

	public function initialize(array $data): void
	{
	}
}