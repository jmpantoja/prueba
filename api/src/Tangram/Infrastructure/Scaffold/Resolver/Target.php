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

namespace Tangram\Infrastructure\Scaffold\Resolver;

use Tangram\Domain\VarType\TypeUtils;
use Tangram\Infrastructure\Scaffold\Model\Attribute;
use Tangram\Infrastructure\Scaffold\Model\Model;

final class Target
{
	private bool $collection = false;
	private bool $endpoint = false;
	private ?string $fullName;
	private string $shortName;
	private string $namespace;
	private array $constants;
	/**
	 * @var Attribute[]
	 */
	private array $attributes;

	public static function builtin(string $key): self
	{
		return new self($key);
	}

	public static function model(string $fullName, Model $model): self
	{
		$newTarget = new self($fullName, $model->attributes(), $model->constants());
		$newTarget->endpoint = $model->isEndpoint();

		return $newTarget;
	}

	public static function collection(Target $target): self
	{
		$newTarget = new self($target->typeFullName(), $target->attributes(), $target->constants());
		$newTarget->collection = true;
		$newTarget->endpoint = $target->endpoint;

		return $newTarget;
	}

	private function __construct(string $fullName, array $attributes = [], array $constants = [])
	{
		$pieces = explode('\\', $fullName);
		if (1 === count($pieces)) {
			$fullName = null;
		}

		$this->fullName = $fullName;
		$this->shortName = array_pop($pieces);
		$this->namespace = implode('\\', $pieces);

		$this->attributes = $attributes;
		$this->constants = $constants;
	}

	public function isEndpoint(): bool
	{
		return $this->endpoint;
	}

	public function isCollection(): bool
	{
		return $this->collection;
	}

	public function isSingle(): bool
	{
		return count($this->attributes()) < 2;
	}

	public function isComposed(): bool
	{
		return !$this->isSingle();
	}

	public function toSingleScalar(): ?string
	{
		$attribute = $this->uniqueAttribute();
		if (is_null($attribute)) {
			return null;
		}

		$type = $attribute->type();
		if (!$type->isBuiltin()) {
			return null;
		}

		$key = $type->key();
		if (!TypeUtils::isNative($key)) {
			return null;
		}

		return $key;
	}

	public function uniqueAttribute(): ?Attribute
	{
		$attributes = $this->attributes();

		if (1 !== count($attributes)) {
			return null;
		}

		return array_pop($attributes);
	}

	public function needToBeImported(): bool
	{
		return !is_null($this->typeFullName());
	}

	public function name(): string
	{
		return $this->shortName;
	}

	public function typeFullName(): ?string
	{
		if ($this->isCollection()) {
			return null;
		}

		return $this->fullName;
	}

	public function typeName(): string
	{
		if ($this->isCollection()) {
			return 'Collection';
		}

		return $this->shortName;
	}

	public function shortName(): string
	{
		return $this->shortName;
	}

	public function fullName(): ?string
	{
		return $this->fullName;
	}

	public function argumentName(): string
	{
		if ($this->isCollection()) {
			return 'array';
		}

		return $this->shortName;
	}

	public function namespace(): string
	{
		return $this->namespace;
	}

	public function constants(): array
	{
		return $this->constants;
	}

	public function attributes(): array
	{
		return $this->attributes;
	}

	public function onlyReadAttributes(): array
	{
		return array_filter($this->attributes, function (Attribute $attribute) {
			return !$attribute->updatable() && !$attribute->isCollection();
		});
	}

	public function collections(): array
	{
		return array_filter($this->attributes, function (Attribute $attribute) {
			return $attribute->isCollection();
		});
	}

	public function properties(): array
	{
		return array_filter($this->attributes, function (Attribute $attribute) {
			return !$attribute->isCollection();
		});
	}

	public function readOnlyAttributes(): array
	{
		return array_filter($this->attributes, function (Attribute $attribute) {
			return !$attribute->updatable();
		});
	}
}
