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

namespace App\Infrastructure\Api\Music\Persister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\Music\DeleteAlbum;
use App\Application\Music\SaveAlbum;
use App\Domain\Music\Album;
use App\Domain\Music\Event\AlbumHasBeenDeleted;
use League\Tactician\CommandBus;
use Tangram\Domain\Model\Traits\NotifyEvents;

final class AlbumPersister implements ContextAwareDataPersisterInterface
{
	use NotifyEvents;

	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function supports($data, array $context = []): bool
	{
		return $data instanceof Album;
	}

	/**
	 * @param Album $album
	 *
	 * @return object|void
	 */
	public function persist($album, array $context = [])
	{
		$command = new SaveAlbum($album);
		$this->commandBus->handle($command);
	}

	/**
	 * @param Album $album
	 *
	 * @return object|void
	 */
	public function remove($album, array $context = [])
	{
		$albumId = $album->id();
		$command = new DeleteAlbum($albumId);

		$this->notify(new AlbumHasBeenDeleted($albumId));

		$this->commandBus->handle($command);
	}
}
