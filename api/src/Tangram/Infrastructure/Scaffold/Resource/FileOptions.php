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

namespace Tangram\Infrastructure\Scaffold\Resource;

final class FileOptions
{
	private string $fileName;
	private string $target;
	private string $template;
	private bool $updatable = false;

	public function updatable()
	{
		$this->updatable = true;
	}

	public function setFileName(string ...$pieces): self
	{
		$this->fileName = implode('.', $pieces);

		return $this;
	}

	public function setTarget(string ...$directories): self
	{
		$this->target = implode('/', $directories);

		return $this;
	}

	public function setTemplate(string $template): FileOptions
	{
		$path = sprintf('%s/../_templates/%s.tpl.php', __DIR__, $template);
		$path = sprintf('%s.twig', $template);

		$this->template = $path;

		return $this;
	}

	public function fileName(): string
	{
		return $this->fileName;
	}

	public function target(): string
	{
		return $this->target;
	}

	public function template(): string
	{
		return $this->template;
	}

	public function isUpdatable(): bool
	{
		return $this->updatable;
	}
}
