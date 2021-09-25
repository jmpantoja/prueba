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

use Exception;

final class Reference
{
	private ModelType $type;
	private string $formattedKey;
	private string $key;

	public static function fromString(string $input): self
	{
		$matches = [];
		$input = trim($input);
		$pattern = '/^(?P<type>.*?)\((?P<module>.*),(?P<name>.*)\)$/';

		if (preg_match($pattern, $input, $matches)) {
			$type = trim($matches['type']);

			return new self(ModelType::from($type), $matches['module'], $matches['name']);
		}

		if (preg_match('/^[\w|\\\]+$/', $input)) {
			$type = ModelType::BUILTIN();

			return new self($type, $input);
		}

		$message = sprintf("La referencia '%s' no es correcta", $input);
		throw new Exception($message);
	}

	private function __construct(ModelType $type, string $module, string $name = null)
	{
		$this->type = $type;
		if (is_null($name)) {
			$this->key = $module;

			return;
		}

		$key = sprintf('%s(%s/%s)', ...[
			$this->type,
			trim($module),
			trim($name),
		]);

		$this->formattedKey = $key;
		$this->key = strtolower($key);
	}

	public function key(): string
	{
		return $this->key;
	}

	public function prettyKey(): string
	{
		return $this->formattedKey;
	}

	public function isBuiltin(): bool
	{
		return $this->type->isBuiltin();
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

	public function isRelation(): bool
	{
		return $this->type->isRelation();
	}

	public function __toString(): string
	{
		return $this->prettyKey();
	}
}
