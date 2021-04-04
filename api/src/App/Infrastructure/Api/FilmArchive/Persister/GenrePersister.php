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
use App\Domain\FilmArchive\Event\GenreHasBeenDeleted;
use App\Domain\FilmArchive\Genre;
use App\Application\FilmArchive\DeleteGenre;
use App\Application\FilmArchive\SaveGenre;


final class GenrePersister  implements ContextAwareDataPersisterInterface {

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
        return $data instanceof Genre;
    }

    /**
    * @param Genre $genre    * @param array $context
    * @return object|void
    */
    public function persist($genre, array $context = [])
    {
        $command = new SaveGenre($genre);
        $this->commandBus->handle($command);
    }

    /**
    * @param Genre $genre    * @param array $context
    * @return object|void
    */
    public function remove($genre, array $context = [])
    {
        $genreId = $genre->id();
        $command = new DeleteGenre($genreId);

        $this->notify(new GenreHasBeenDeleted($genreId));

        $this->commandBus->handle($command);
    }

}
