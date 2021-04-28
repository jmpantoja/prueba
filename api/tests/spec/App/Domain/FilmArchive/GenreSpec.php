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

namespace spec\App\Domain\FilmArchive;

use App\Domain\FilmArchive\Event\GenreHasBeenCreated;
use App\Domain\FilmArchive\Event\GenreHasBeenUpdated;
use App\Domain\FilmArchive\Genre;
use App\Domain\FilmArchive\GenreId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\DomainEventsCollector;


final class GenreSpec extends ObjectBehavior
{
    private function eventsCollector(DomainEventsCollector $eventsCollector): void
    {
        $eventsCollector->handle(Argument::any())->willReturn($eventsCollector);
        DomainEventDispatcher::instance()
            ->setDomainEventsCollector($eventsCollector->getWrappedObject());
    }

    private function input(): array
    {
        return [
            'name' => 'name'
        ];
    }

    public function let(DomainEventsCollector $eventsCollector)
    {
        $this->eventsCollector($eventsCollector);

        $args = $this->input();
        $this->beConstructedWith(...array_values($args));
    }

    public function it_is_initializable(DomainEventsCollector $eventsCollector)
    {
        $this->shouldHaveType(Genre::class);
        $eventsCollector->handle(Argument::type(GenreHasBeenCreated::class))->shouldBeCalledOnce();
    }

    public function it_implements_entity_interface()
    {
        $this->shouldHaveType(Genre::class);
        $this->id()->shouldHaveType(GenreId::class);
    }

    public function it_is_updatable(DomainEventsCollector $eventsCollector)
    {
        $this->update(...$this->input());
        $eventsCollector->handle(Argument::type(GenreHasBeenUpdated::class))->shouldBeCalledOnce();
    }

}
