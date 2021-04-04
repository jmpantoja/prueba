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

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use League\Tactician\CommandBus;
use Tangram\Domain\Model\Traits\NotifyEvents;
use <?= $deleteEvent['fullName']?>;
use <?= $entity['fullName']?>;
use <?= $deleteCommand['fullName']?>;
use <?= $saveCommand['fullName']?>;


final class <?= $class_name ?>  implements ContextAwareDataPersisterInterface {

    use NotifyEvents;

    /**
    * @var CommandBus
    */
    private CommandBus $commandBus;

    public function __construct( CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    public function supports($data, array $context = []): bool
    {
        return $data instanceof <?= $entity['shortName']?>;
    }

    /**
    * @param <?= $entity['shortName']?> $<?= $entity['varName']?>
    * @param array $context
    * @return object|void
    */
    public function persist($<?= $entity['varName']?>, array $context = [])
    {
        $command = new <?= $saveCommand['shortName']?>($<?= $entity['varName']?>);
        $this->commandBus->handle($command);
    }

    /**
    * @param <?= $entity['shortName']?> $<?= $entity['varName']?>
    * @param array $context
    * @return object|void
    */
    public function remove($<?= $entity['varName']?>, array $context = [])
    {
        $<?= $entityId['varName']?> = $<?= $entity['varName']?>->id();
        $command = new <?= $deleteCommand['shortName']?>($<?= $entityId['varName']?>);

        $this->notify(new <?= $deleteEvent['shortName']?>($<?= $entityId['varName']?>));

        $this->commandBus->handle($command);
    }

}
