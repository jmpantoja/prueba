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

abstract class Model
{
	private string $prefix;
	private string $module;
	private string $name;
	private array $constants;
	private array $attributes;
	private string $key;

	public function __construct(array $input)
	{
		$options = ModelOptions::make();
		$this->configure($options);
		$data = $options->resolve($input);

		$this->prefix = $data['prefix'];
		$this->module = $data['module'];
		$this->name = $data['name'];

		$this->constants = $data['constants'] ?? [];

		$this->setAttributes(...[
			$data['properties'] ?? [],
			$data['relations'] ?? [],
		]);

		$key = sprintf('%s(%s/%s)', $this->typeName(), $this->module, $this->name);
		$this->key = strtolower($key);

		$this->initialize($data);
	}

	private function setAttributes(array $properties, array $relations)
	{
		$attributes = array_merge($properties, $relations);
		usort($attributes, function (Attribute $first, Attribute $second) {
			if ($first->isToOne() || $second->isToMany()) {
				return -1;
			}
			if ($first->isToMany() || $second->isToOne()) {
				return 1;
			}

			return 0;
		});

		$this->attributes = $attributes;
	}

	abstract public function initialize(array $data): void;

	abstract public function configure(ModelOptions $options): void;

	public function isSingle(): bool
	{
		return count($this->attributes()) < 2;
	}

	public function isComposed(): bool
	{
		return !$this->isSingle();
	}

	private function typeName(): string
	{
		return match (static::class) {
			Entity::class => 'Entity',
			ValueObject::class => 'VO',
			Enum::class => 'Enum'
		};
	}

	public function isEntity(): bool
	{
		return $this instanceof Entity;
	}

	public function isEndpoint(): bool
	{
		if ($this instanceof Entity) {
			return $this->isEndpoint();
		}

		return false;
	}

	public function isValueObject(): bool
	{
		return $this instanceof ValueObject;
	}

	public function isEnum(): bool
	{
		return $this instanceof Enum;
	}

	public function prefix(): string
	{
		return $this->prefix;
	}

	public function module(): string
	{
		return $this->module;
	}

	public function name(): string
	{
		return $this->name;
	}

	public function key(): string
	{
		return $this->key;
	}

	public function constants(): array
	{
		return $this->constants;
	}

	public function attributes(): array
	{
		return $this->attributes;
	}
}
