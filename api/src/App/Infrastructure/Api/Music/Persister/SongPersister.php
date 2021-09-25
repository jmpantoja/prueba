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
use App\Application\Music\DeleteSong;
use App\Application\Music\SaveSong;
use App\Domain\Music\Event\SongHasBeenDeleted;
use App\Domain\Music\Song;
use League\Tactician\CommandBus;
use Tangram\Domain\Model\Traits\NotifyEvents;

final class SongPersister implements ContextAwareDataPersisterInterface
{
	use NotifyEvents;

	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function supports($data, array $context = []): bool
	{
		return $data instanceof Song;
	}

	/**
	 * @param Song $song
	 *
	 * @return object|void
	 */
	public function persist($song, array $context = [])
	{
		$command = new SaveSong($song);
		$this->commandBus->handle($command);
	}

	/**
	 * @param Song $song
	 *
	 * @return object|void
	 */
	public function remove($song, array $context = [])
	{
		$songId = $song->id();
		$command = new DeleteSong($songId);

		$this->notify(new SongHasBeenDeleted($songId));

		$this->commandBus->handle($command);
	}
}
