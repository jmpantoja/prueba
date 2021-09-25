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
use App\Application\Music\DeleteMusicGroup;
use App\Application\Music\SaveMusicGroup;
use App\Domain\Music\Event\MusicGroupHasBeenDeleted;
use App\Domain\Music\MusicGroup;
use League\Tactician\CommandBus;
use Tangram\Domain\Model\Traits\NotifyEvents;

final class MusicGroupPersister implements ContextAwareDataPersisterInterface
{
	use NotifyEvents;

	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function supports($data, array $context = []): bool
	{
		return $data instanceof MusicGroup;
	}

	/**
	 * @param MusicGroup $musicGroup
	 *
	 * @return object|void
	 */
	public function persist($musicGroup, array $context = [])
	{
		$command = new SaveMusicGroup($musicGroup);
		$this->commandBus->handle($command);
	}

	/**
	 * @param MusicGroup $musicGroup
	 *
	 * @return object|void
	 */
	public function remove($musicGroup, array $context = [])
	{
		$musicGroupId = $musicGroup->id();
		$command = new DeleteMusicGroup($musicGroupId);

		$this->notify(new MusicGroupHasBeenDeleted($musicGroupId));

		$this->commandBus->handle($command);
	}
}
