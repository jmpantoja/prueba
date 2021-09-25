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

namespace spec\App\Domain\Music;

use App\Domain\Music\Event\MusicGroupHasBeenCreated;
use App\Domain\Music\Event\MusicGroupHasBeenUpdated;
use App\Domain\Music\MusicGroup;
use App\Domain\Music\MusicGroupId;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\DomainEventsCollector;

final class MusicGroupSpec extends ObjectBehavior
{
	private function eventsCollector(DomainEventsCollector $eventsCollector): void
	{
		$eventsCollector->handle(Argument::any())->willReturn($eventsCollector);
		DomainEventDispatcher::instance()
->setDomainEventsCollector($eventsCollector->getWrappedObject());
	}

	private function input(): array
	{
		throw new PendingException('Este método debería devolver un array con los argumentos (con nombre y en orden) para crear la entidad');

		return [
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
		$this->shouldHaveType(MusicGroup::class);
		$eventsCollector->handle(Argument::type(MusicGroupHasBeenCreated::class))->shouldBeCalledOnce();
	}

	public function it_implements_entity_interface()
	{
		$this->shouldHaveType(MusicGroup::class);
		$this->id()->shouldHaveType(MusicGroupId::class);
	}

	public function it_is_updatable(DomainEventsCollector $eventsCollector)
	{
		$this->update(...$this->input());
		$eventsCollector->handle(Argument::type(MusicGroupHasBeenUpdated::class))->shouldBeCalledOnce();
	}
}
