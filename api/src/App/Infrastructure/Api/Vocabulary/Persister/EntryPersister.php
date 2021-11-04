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

namespace App\Infrastructure\Api\Vocabulary\Persister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Application\Vocabulary\DeleteEntry;
use App\Application\Vocabulary\SaveEntry;
use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\Event\EntryHasBeenDeleted;
use League\Tactician\CommandBus;
use Tangram\Domain\Model\Traits\NotifyEvents;

final class EntryPersister implements ContextAwareDataPersisterInterface
{
	use NotifyEvents;

	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function supports($data, array $context = []): bool
	{
		return $data instanceof Entry;
	}

	/**
	 * @param Entry $entry
	 *
	 * @return object|void
	 */
	public function persist($entry, array $context = [])
	{
		$command = new SaveEntry($entry);
		$this->commandBus->handle($command);
	}

	/**
	 * @param Entry $entry
	 *
	 * @return object|void
	 */
	public function remove($entry, array $context = [])
	{
		$entryId = $entry->id();
		$command = new DeleteEntry($entryId);

		$this->notify(new EntryHasBeenDeleted($entryId));

		$this->commandBus->handle($command);
	}
}
