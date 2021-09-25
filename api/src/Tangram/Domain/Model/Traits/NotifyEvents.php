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

namespace Tangram\Domain\Model\Traits;

use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\DomainEventInterface;

trait NotifyEvents
{
	final public function notify(DomainEventInterface $domainEvent): void
	{
		DomainEventDispatcher::instance()
			->dispatch($domainEvent);
	}
}
