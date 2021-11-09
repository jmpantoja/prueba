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
use App\Domain\Vocabulary\Event\MeaningHasBeenCreated;
use App\Domain\Vocabulary\Event\MeaningHasBeenUpdated;
use App\Domain\Vocabulary\Meaning;
use App\Domain\Vocabulary\MeaningId;
use App\Domain\Vocabulary\VO\Deep;
use App\Domain\Vocabulary\VO\Lang;
use App\Domain\Vocabulary\VO\Term;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\DomainEventsCollector;

final class MeaningSpec extends ObjectBehavior
{
	private function eventsCollector(DomainEventsCollector $eventsCollector): void
	{
		$eventsCollector->handle(Argument::any())->willReturn($eventsCollector);
		DomainEventDispatcher::instance()
			->setDomainEventsCollector($eventsCollector->getWrappedObject());
	}

	private function input(Entry $entry): array
	{
		return [
			'entry' => $entry,
			'term' => new Term('significado', Lang::SPANISH()),
			'deep' => new Deep(1),
		];
	}

	public function let(DomainEventsCollector $eventsCollector, Entry $entry)
	{
		$this->eventsCollector($eventsCollector);

		$args = $this->input($entry);
		$this->beConstructedWith(...array_values($args));
	}

	public function it_is_initializable(DomainEventsCollector $eventsCollector)
	{
		$this->shouldHaveType(Meaning::class);
		$eventsCollector->handle(Argument::type(MeaningHasBeenCreated::class))->shouldBeCalledOnce();
	}

	public function it_implements_entity_interface()
	{
		$this->shouldHaveType(Meaning::class);
		$this->id()->shouldHaveType(MeaningId::class);
	}

	public function it_is_updatable(DomainEventsCollector $eventsCollector)
	{
		$input = [
			'term' => new Term('significado', Lang::SPANISH()),
			'deep' => new Deep(1),
		];

		$this->update(...$input);
		$eventsCollector->handle(Argument::type(MeaningHasBeenUpdated::class))->shouldBeCalledOnce();
	}

	public function it_gets_entry_properly()
	{
		$this->entry()->shouldHaveType(Entry::class);
	}

	public function it_gets_term_properly()
	{
		$this->term()->shouldHaveType(Term::class);
	}

	public function it_gets_deep_properly()
	{
		$this->deep()->shouldHaveType(Deep::class);
	}
}
