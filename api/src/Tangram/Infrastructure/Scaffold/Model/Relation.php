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

final class Relation extends Attribute
{
	private string $singular;
	private bool $aggregate;
	private ?string $mappingField;

	public function configure(AttributeOptions $options): void
	{
		$options
			->withSingular()
			->withAggregate()
			->withMappingField()
			->withRelationTypes();
	}

	public function initialize(array $data): void
	{
		$this->singular = $data['singular'];
		$this->aggregate = $data['aggregate'];
		$this->mappingField = $data['mapping_field'];
	}

	public function singular(): string
	{
		return $this->singular;
	}

	public function aggregate(): bool
	{
		return $this->aggregate;
	}

	public function mappingField(): ?string
	{
		return $this->mappingField;
	}
}
