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
use App\Domain\FilmArchive\Event\MovieHasBeenDeleted;
use App\Domain\FilmArchive\Movie;
use App\Application\FilmArchive\DeleteMovie;
use App\Application\FilmArchive\SaveMovie;


final class MoviePersister  implements ContextAwareDataPersisterInterface {

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
        return $data instanceof Movie;
    }

    /**
    * @param Movie $movie    * @param array $context
    * @return object|void
    */
    public function persist($movie, array $context = [])
    {
        $command = new SaveMovie($movie);
        $this->commandBus->handle($command);
    }

    /**
    * @param Movie $movie    * @param array $context
    * @return object|void
    */
    public function remove($movie, array $context = [])
    {
        $movieId = $movie->id();
        $command = new DeleteMovie($movieId);

        $this->notify(new MovieHasBeenDeleted($movieId));

        $this->commandBus->handle($command);
    }

}
