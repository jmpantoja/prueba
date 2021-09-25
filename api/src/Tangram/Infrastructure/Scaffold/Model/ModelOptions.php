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
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ModelOptions
{
	private OptionsResolver $resolver;

	public static function make(): self
	{
		return new self();
	}

	private function __construct()
	{
		$this->resolver = new OptionsResolver();

		$this->resolver->setRequired('prefix');
		$this->resolver->setAllowedTypes('prefix', 'string');

		$this->resolver->setRequired('module');
		$this->resolver->setAllowedTypes('module', 'string');

		$this->resolver->setRequired('name');
		$this->resolver->setAllowedTypes('name', 'string');
	}

	public function withConstants(): self
	{
		$this->resolver->setRequired('constants');
		$this->resolver->setAllowedTypes('constants', 'array');
		$this->resolver->setDefault('constants', []);

		$this->resolver->setNormalizer('constants', Closure::fromCallable([$this, 'normalizeConstants']));

		return $this;
	}

	private function normalizeConstants(OptionsResolver $resolver, $input)
	{
		return array_map(function ($key, $value) {
			return new Constant($key, $value);
		}, array_keys($input), $input);
	}

	public function withProperties(): self
	{
		$this->resolver->setRequired('properties');
		$this->resolver->setAllowedTypes('properties', 'array');
		$this->resolver->setDefault('properties', []);

		$this->resolver->setNormalizer('properties', Closure::fromCallable([$this, 'normalizeProperties']));

		return $this;
	}

	private function normalizeProperties(OptionsResolver $resolver, $input)
	{
		return array_map(function ($values) {
			return new Property($values);
		}, $input);
	}

	public function withRelations(): self
	{
		$this->resolver->setRequired('relations');
		$this->resolver->setAllowedTypes('relations', 'array');
		$this->resolver->setDefault('relations', []);

		$this->resolver->setNormalizer('relations', Closure::fromCallable([$this, 'normalizeRelations']));

		return $this;
	}

	private function normalizeRelations(OptionsResolver $resolver, $input)
	{
		return array_map(function ($values) {
			return new Relation($values);
		}, $input);
	}

	public function withEndpoint(): self
	{
		$this->resolver->setRequired('endpoint');
		$this->resolver->setAllowedTypes('endpoint', 'bool');
		$this->resolver->setDefault('endpoint', false);

		return $this;
	}

	public function resolve(array $input): array
	{
		return $this->resolver->resolve($input);
	}
}
