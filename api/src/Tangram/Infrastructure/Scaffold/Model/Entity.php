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

final class Entity extends Model
{
	private bool $endpoint;

	public function configure(ModelOptions $options): void
	{
		$options
			->withConstants()
			->withProperties()
			->withRelations()
			->withEndpoint();
	}

	public function initialize(array $data): void
	{
		$this->endpoint = $data['endpoint'];
	}

	public function isEndpoint(): bool
	{
		return $this->endpoint;
	}
}
