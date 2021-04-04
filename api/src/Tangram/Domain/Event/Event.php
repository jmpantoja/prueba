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


use DateTimeInterface;
use Laminas\Filter\Word\CamelCaseToSeparator;
use PlanB\Edge\Infrastructure\Symfony\Serializer\Normalizer\DomainEventNormalizer;

class Event
{
    private const NON_ALLOWED_WORDS = ['has', 'been', 'was', 'event', 'spec', 'entity', 'document', 'model', 'phpcr', 'couchdocument', 'domain', 'doctrine', 'orm', 'mongodb', 'couchdb'];

    private EventId $id;

    private string $name;

    private string $event;

    private DateTimeInterface $date;

    public function __construct(string $name, string $event, DateTimeInterface $date)
    {
        $this->id = new EventId();

        $this->setName($name);
        $this->setEvent($event);
        $this->date = $date;
    }

    /**
     * @param string $name
     */
    private function setName(string $name): self
    {

        $pieces = explode('\\', $name);
        $pieces = array_map(function ($piece) {
            return $this->normalize($piece);
        }, $pieces);

        $pieces = array_filter($pieces);
        $eventName = implode('.', $pieces);

        $this->name = $eventName;

        return $this;
    }

    private function normalize(string $name)
    {
        $filter = new CamelCaseToSeparator('_');
        $name = strtolower($filter->filter($name));

        $pieces = explode('_', $name);
        $pieces = array_filter($pieces, function (string $item) {
            return !in_array($item, self::NON_ALLOWED_WORDS);
        });

        return implode('_', $pieces);
    }

    private function setEvent(string $event): self
    {
        $this->event = $event;
        return $this;
    }

    /**
     * @return int
     */
    public function id(): EventId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function event(): string
    {
        return $this->event;
    }

    /**
     * @return DateTimeInterface
     */
    public function date(): DateTimeInterface
    {
        return $this->date;
    }
}
