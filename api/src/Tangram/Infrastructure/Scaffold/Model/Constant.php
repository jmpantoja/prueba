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

final class Constant
{
	private string $name;
	private mixed $value;

	public function __construct(string $name, mixed $value)
	{
		$this->name = strtoupper($name);
		$this->value = $value;
	}

	public function name(): string
	{
		return $this->name;
	}

	public function value(): mixed
	{
		return $this->value;
	}
}
