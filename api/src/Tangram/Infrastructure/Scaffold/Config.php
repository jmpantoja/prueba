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

use ArrayIterator;
use IteratorAggregate;
use Tangram\Infrastructure\Scaffold\Model\Entity;
use Tangram\Infrastructure\Scaffold\Model\Enum;
use Tangram\Infrastructure\Scaffold\Model\ValueObject;

final class Config implements IteratorAggregate
{
	private string $prefix;

	private array $definitions;

	public static function make(string $prefix, array $data): self
	{
		return new self($prefix, $data);
	}

	private function __construct(string $prefix, array $data)
	{
		$this->prefix = $prefix;

		$definitions = [];

		$definitions[] = array_map(function (array $config) {
			$config['prefix'] = $this->prefix;

			return new Entity($config);
		}, $data['entities'] ?? []);

		$definitions[] = array_map(function (array $config) {
			$config['prefix'] = $this->prefix;

			return new ValueObject($config);
		}, $data['valueObjects'] ?? []);

		$definitions[] = array_map(function (array $config) {
			$config['prefix'] = $this->prefix;

			return new Enum($config);
		}, $data['enums'] ?? []);

		$this->definitions = array_merge(...$definitions);
	}

	public function definitions(): array
	{
		return $this->definitions;
	}

	public function getIterator(): \Iterator
	{
		return new ArrayIterator($this->definitions);
	}
}
