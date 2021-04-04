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


use BadMethodCallException;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventDispatcher as BaseEventDispatcher;

final class DomainEventDispatcher extends BaseEventDispatcher
{
    protected static ?DomainEventDispatcher $instance = null;
    private DomainEventsCollector $eventsCollector;

    final private function __construct()
    {
        parent::__construct();
        $this->eventsCollector = new DomainEventsCollector();
    }

    public static function instance(): self
    {
        if (static::$instance === null) {
            static::$instance = new self();
        }

        return static::$instance;
    }

    public function setDomainEventsCollector(DomainEventsCollector $eventsCollector): self
    {
        $this->eventsCollector = $eventsCollector;
        return $this;
    }

    /**
     * @return DomainEventsCollector
     */
    public function eventsCollector(): DomainEventsCollector
    {
        return $this->eventsCollector;
    }

    /**
     * @param object $event
     * @param null $eventName
     * @return object|Event|\Symfony\Contracts\EventDispatcher\Event
     */
    public function dispatch($event, $eventName = null): object
    {
        if ($event instanceof DomainEventInterface) {
            $this->eventsCollector->handle($event);
        }

        return parent::dispatch($event, $eventName);
    }

    public function __clone()
    {
        throw new BadMethodCallException('Este objeto no puede ser clonado');
    }

    public function __wakeup()
    {
        throw new BadMethodCallException('Este objeto no puede ser deserializado');
    }

}
