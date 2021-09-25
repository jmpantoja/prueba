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

final class Action
{
	private string $path;
	private string $template;
	private bool $updatable;
	private array $vars;

	/**
	 * @param array|Resolver\Target[] $vars
	 */
	public function __construct(Task $task, array $vars)
	{
		$this->path = $task->path();
		$this->template = $task->template();
		$this->updatable = $task->isUpdatable();
		$this->vars = array_merge($vars, [
			'target' => $task->target(),
		]);
	}

	public function path(): string
	{
		return $this->path;
	}

	public function template(): string
	{
		return $this->template;
	}

	public function isUpdatable(): bool
	{
		return $this->updatable;
	}

	public function vars(): array
	{
		return $this->vars;
	}
}
