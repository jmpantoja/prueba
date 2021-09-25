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

namespace Tangram\Infrastructure\Scaffold;

use Tangram\Infrastructure\Scaffold\Resolver\Target;

final class Task
{
	private string $path;
	private string $template;
	private ?Target $target;

	private bool $updatable;

	public function __construct(string $path, string $template, ?Target $target, bool $updatable = false)
	{
		$this->path = $path;
		$this->template = $template;
		$this->target = $target;
		$this->updatable = $updatable;
	}

	public function path(): string
	{
		return $this->path;
	}

	public function template(): string
	{
		return $this->template;
	}

	public function target(): ?Target
	{
		return $this->target;
	}

	public function isUpdatable(): bool
	{
		return $this->updatable;
	}
}
