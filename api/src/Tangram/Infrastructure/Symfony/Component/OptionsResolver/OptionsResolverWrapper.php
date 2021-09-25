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

namespace Tangram\Infrastructure\Symfony\Component\OptionsResolver;

use Symfony\Component\OptionsResolver\OptionsResolver;

abstract class OptionsResolverWrapper
{
	private OptionsResolver $resolver;

	public static function make(): static
	{
		return new static();
	}

	public function __construct()
	{
		$resolver = new OptionsResolver();
		$this->configure($resolver);
		$this->resolver = $resolver;
	}

	abstract public function configure(OptionsResolver $resolver): void;

	public function resolve(array $options): array
	{
		return $this->resolver->resolve($options);
	}
}
