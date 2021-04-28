<?= "<?php\n" ?>
/**
* This file is part of the planb project.
*
* (c) jmpantoja <jmpantoja@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

declare(strict_types=1);

namespace <?= $namespace ?>;

use <?= $entity['fullName'] ?>;
use <?= $createEvent['fullName'] ?>;
use <?= $updateEvent['fullName'] ?>;
use <?= $entityId['fullName'] ?>;
use PhpSpec\Exception\Example\PendingException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Tangram\Domain\Event\DomainEventDispatcher;
use Tangram\Domain\Event\DomainEventsCollector;
use Tangram\Domain\Model\Entity;


final class <?= $class_name ?>  extends ObjectBehavior
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
        $this->shouldHaveType(<?= $entity['shortName'] ?>::class);
        $eventsCollector->handle(Argument::type(<?= $createEvent['shortName'] ?>::class))->shouldBeCalledOnce();
    }

    public function it_implements_entity_interface()
    {
        $this->shouldHaveType(<?= $entity['shortName'] ?>::class);
        $this->id()->shouldHaveType(<?= $entityId['shortName'] ?>::class);
    }

    public function it_is_updatable(DomainEventsCollector $eventsCollector)
    {
        $this->update(...$this->input());
        $eventsCollector->handle(Argument::type(<?= $updateEvent['shortName'] ?>::class))->shouldBeCalledOnce();
    }

}
