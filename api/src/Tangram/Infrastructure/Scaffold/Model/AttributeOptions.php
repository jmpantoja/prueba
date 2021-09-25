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

use Closure;
use Exception;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class AttributeOptions
{
	private OptionsResolver $resolver;

	public static function make(): self
	{
		return new self();
	}

	private function __construct()
	{
		$this->resolver = new OptionsResolver();

		$this->resolver->setRequired('name');
		$this->resolver->setAllowedTypes('name', 'string');

		$this->resolver->setRequired('type');
		$this->resolver->setAllowedTypes('type', 'string');
		$this->resolver->setNormalizer('type', Closure::fromCallable([$this, 'normalizeType']));

		$this->resolver->setDefault('nullable', false);
		$this->resolver->setAllowedTypes('nullable', 'bool');

		$this->resolver->setRequired('updatable');
		$this->resolver->setDefault('updatable', true);
		$this->resolver->setAllowedTypes('updatable', 'bool');
	}

	private function normalizeType(OptionsResolver $resolver, $value): Reference
	{
		return Reference::fromString($value);
	}

	public function resolve(array $input): array
	{
		return $this->resolver->resolve($input);
	}

	public function withSingular(): self
	{
		$this->resolver->setRequired('singular');
		$this->resolver->setDefault('singular', null);
		$this->resolver->setAllowedTypes('singular', ['string', 'null']);
		$this->resolver->setNormalizer('singular', function (OptionsResolver $resolver, $value) {
			return empty($value) ? $resolver['name'] : $value;
		});

		return $this;
	}

	public function withAggregate(): self
	{
		$this->resolver->setRequired('aggregate');
		$this->resolver->setDefault('aggregate', false);
		$this->resolver->setAllowedTypes('aggregate', 'bool');

		return $this;
	}

	public function withMappingField(): self
	{
		$this->resolver->setRequired('mapping_field');
		$this->resolver->setDefault('mapping_field', null);
		$this->resolver->setAllowedTypes('mapping_field', ['string', 'null']);

		return $this;
	}

	public function withRelationTypes(): self
	{
		$this->resolver->addNormalizer('type', function (OptionsResolver $resolver, Reference $reference) {
			if (!$reference->isRelation()) {
				$message = sprintf('La propiedad "%s" es una relación, y no admite el tipo "%s"', ...[
					$resolver['name'],
					$reference,
				]);
				throw new Exception($message);
			}

			return $reference;
		});

		return $this;
	}

	public function withPropertyTypes(): self
	{
		$this->resolver->addNormalizer('type', function (OptionsResolver $resolver, Reference $reference) {
			if ($reference->isRelation()) {
				$message = sprintf('La propiedad "%s" es una atributo, y no admite el tipo "%s"', ...[
					$resolver['name'],
					$reference,
				]);
				throw new Exception($message);
			}

			return $reference;
		});

		return $this;
	}
}
