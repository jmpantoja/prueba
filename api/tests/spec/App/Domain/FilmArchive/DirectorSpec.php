<?php

namespace spec\App\Domain\FilmArchive;

use App\Domain\FilmArchive\Director;
use App\Domain\FilmArchive\DirectorId;
use App\Domain\FilmArchive\Event\DirectorHasBeenCreated;
use App\Domain\FilmArchive\Event\DirectorHasBeenUpdated;
use App\Domain\FilmArchive\MovieList;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\DomainEventsCollector;
use Tangram\Domain\Model\Entity;
use Tangram\Domain\ValueObject\FullName;

class DirectorSpec extends ObjectBehavior
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
            'name' => new FullName('name', 'lastName'),
            'movies' => MovieList::collect()
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
        $this->shouldHaveType(Director::class);
        $eventsCollector->handle(Argument::type(DirectorHasBeenCreated::class))->shouldBeCalledOnce();
    }

    public function it_implements_entity_interface()
    {
        $this->shouldHaveType(Entity::class);
        $this->id()->shouldHaveType(DirectorId::class);
    }

    public function it_is_updatable(DomainEventsCollector $eventsCollector)
    {
        $this->update(...$this->input());
        $eventsCollector->handle(Argument::type(DirectorHasBeenUpdated::class))->shouldBeCalledOnce();
    }


}
