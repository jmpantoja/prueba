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

abstract class Attribute
{
	private string $name;
	private Reference $type;
	private bool $nullable;
	private bool $updatable;
	private mixed $default;
	private bool $hasDefaultValue = false;

	public function __construct(array $input)
	{
		$options = AttributeOptions::make();
		$this->configure($options);
		$data = $options->resolve($input);

		$this->name = $data['name'];
		$this->type = $data['type'];
		$this->nullable = $data['nullable'];
		$this->updatable = $data['updatable'];

		$this->initialize($data);
	}

	abstract public function configure(AttributeOptions $options): void;

	abstract public function initialize(array $data): void;

	public function name(): string
	{
		return $this->name;
	}

	public function type(): Reference
	{
		return $this->type;
	}

	public function nullable(): bool
	{
		return $this->nullable;
	}

	public function updatable(): mixed
	{
		return $this->updatable;
	}

	public function isRelation(): bool
	{
		return $this->type->isRelation();
	}

	public function isCollection(): bool
	{
		return $this->type->isToMany();
	}

	public function isToMany(): bool
	{
		return $this->type->isToMany();
	}

	public function isToOne(): bool
	{
		return $this->type->isToOne();
	}

	public function isManyToOne(): bool
	{
		return $this->type->isManyToOne();
	}

	public function isManyToMany(): bool
	{
		return $this->type->isManyToMany();
	}

	public function isOneToOne(): bool
	{
		return $this->type->isOneToOne();
	}

	public function isOneToMany(): bool
	{
		return $this->type->isOneToMany();
	}
}
