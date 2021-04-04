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

namespace Tangram\Infrastructure\Tactician;


use League\Tactician\Middleware;
use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\EventStore;

final class DomainEventsMiddleware implements Middleware
{

    private EventStore $repository;

    public function __construct(EventStore $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function execute($command, callable $next)
    {
        $eventDispatcher = DomainEventDispatcher::instance();
        $eventsCollector = $eventDispatcher->eventsCollector();

        $response = $next($command);
        $events = $eventsCollector->events();


        foreach ($events as $event) {
            $this->repository->persist($event);
        }

        return $response;
    }
}
