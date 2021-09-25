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

final class ClassOptions
{
	private string $prefix;

	private string $className;

	private string $namespace;

	private string $template;

	private bool $updatable = false;

	private bool $test = false;

	public function __construct(string $prefix)
	{
		$this->prefix = $prefix;
	}

	public function asTest()
	{
		$this->test = true;
	}

	public function updatable()
	{
		$this->updatable = true;
	}

	public function setClassName(string ...$params): static
	{
		$this->className = implode('', $params);

		return $this;
	}

	public function setNamespace(string ...$params): static
	{
		$this->namespace = implode('\\', $params);

		return $this;
	}

	public function setTemplate(string $template): static
	{
		$path = sprintf('%s.php.twig', $template);
		$this->template = $path;

		return $this;
	}

	public function className(): string
	{
		return $this->className;
	}

	public function namespace(): string
	{
		if ($this->isTest()) {
			return sprintf('spec\%s\%s', $this->prefix, $this->namespace);
		}

		return sprintf('%s\%s', $this->prefix, $this->namespace);
	}

	public function fqn()
	{
		return sprintf('%s\%s', $this->namespace(), $this->className);
	}

	public function template(): string
	{
		return $this->template;
	}

	public function isTest(): bool
	{
		return $this->test;
	}

	public function isUpdatable(): bool
	{
		return $this->updatable;
	}
}
