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

namespace Tangram\Domain\Event;

use Carbon\CarbonImmutable;
use DateTimeInterface;

abstract class DomainEvent implements DomainEventInterface
{
	private DateTimeInterface $when;
	private object $event;

	public function __construct(mixed $event, DateTimeInterface $when = null)
	{
		$this->event = $event;
		$this->when = $when ?? CarbonImmutable::now();
	}

	public function when(): DateTimeInterface
	{
		return $this->when;
	}

	public function jsonSerialize()
	{
		return $this->event;
	}
}
