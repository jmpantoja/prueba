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

namespace spec\App\Domain\Vocabulary;

use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\EntryId;
use App\Domain\Vocabulary\Event\EntryHasBeenCreated;
use App\Domain\Vocabulary\Event\EntryHasBeenUpdated;
use App\Domain\Vocabulary\Input\MeaningInput;
use App\Domain\Vocabulary\MeaningList;
use App\Domain\Vocabulary\VO\AudioPath;
use App\Domain\Vocabulary\VO\Deep;
use App\Domain\Vocabulary\VO\EntryType;
use App\Domain\Vocabulary\VO\Lang;
use App\Domain\Vocabulary\VO\Level;
use App\Domain\Vocabulary\VO\Term;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\DomainEventsCollector;

final class EntrySpec extends ObjectBehavior
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
			'type' => EntryType::WORD(),
			'term' => new Term('palabra', Lang::ENGLISH()),
			'level' => new Level(1, 1),
			'audio' => new AudioPath('/path/to/audio.mp3'),
			'meanings' => [
				MeaningInput::fromArray(['term' => new Term('significado 1', Lang::SPANISH()), 'deep' => new Deep(1)]),
				MeaningInput::fromArray(['term' => new Term('significado 2', Lang::SPANISH()), 'deep' => new Deep(2)]),
			],
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
		$this->shouldHaveType(Entry::class);
		$eventsCollector->handle(Argument::type(EntryHasBeenCreated::class))->shouldBeCalledOnce();
	}

	public function it_implements_entity_interface()
	{
		$this->shouldHaveType(Entry::class);
		$this->id()->shouldHaveType(EntryId::class);
	}

	public function it_is_updatable(DomainEventsCollector $eventsCollector)
	{
		$this->update(...$this->input());
		$eventsCollector->handle(Argument::type(EntryHasBeenUpdated::class))->shouldBeCalledOnce();
	}

	public function it_gets_type_properly()
	{
		$this->type()->shouldHaveType(EntryType::class);
	}

	public function it_gets_term_properly()
	{
		$this->term()->shouldHaveType(Term::class);
	}

	public function it_gets_level_properly()
	{
		$this->level()->shouldHaveType(Level::class);
	}

	public function it_gets_audio_properly()
	{
		$this->audio()->shouldHaveType(AudioPath::class);
	}

	public function it_gets_meanings_properly()
	{
		$this->meanings()->shouldHaveType(MeaningList::class);
	}
}
