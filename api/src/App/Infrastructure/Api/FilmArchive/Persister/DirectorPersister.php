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

namespace App\Infrastructure\Api\FilmArchive\Persister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use League\Tactician\CommandBus;
use Tangram\Domain\Model\Traits\NotifyEvents;
use App\Domain\FilmArchive\Event\DirectorHasBeenDeleted;
use App\Domain\FilmArchive\Director;
use App\Application\FilmArchive\DeleteDirector;
use App\Application\FilmArchive\SaveDirector;


final class DirectorPersister  implements ContextAwareDataPersisterInterface {

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
        return $data instanceof Director;
    }

    /**
    * @param Director $director    * @param array $context
    * @return object|void
    */
    public function persist($director, array $context = [])
    {
        $command = new SaveDirector($director);
        $this->commandBus->handle($command);
    }

    /**
    * @param Director $director    * @param array $context
    * @return object|void
    */
    public function remove($director, array $context = [])
    {
        $directorId = $director->id();
        $command = new DeleteDirector($directorId);

        $this->notify(new DirectorHasBeenDeleted($directorId));

        $this->commandBus->handle($command);
    }

}
