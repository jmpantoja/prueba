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
use App\Application\Vocabulary\DeleteMeaning;
use App\Application\Vocabulary\SaveMeaning;
use App\Domain\Vocabulary\Event\MeaningHasBeenDeleted;
use App\Domain\Vocabulary\Meaning;
use League\Tactician\CommandBus;
use Tangram\Domain\Model\Traits\NotifyEvents;

final class MeaningPersister implements ContextAwareDataPersisterInterface
{
	use NotifyEvents;

	private CommandBus $commandBus;

	public function __construct(CommandBus $commandBus)
	{
		$this->commandBus = $commandBus;
	}

	public function supports($data, array $context = []): bool
	{
		return $data instanceof Meaning;
	}

	/**
	 * @param Meaning $meaning
	 *
	 * @return object|void
	 */
	public function persist($meaning, array $context = [])
	{
		$command = new SaveMeaning($meaning);
		$this->commandBus->handle($command);
	}

	/**
	 * @param Meaning $meaning
	 *
	 * @return object|void
	 */
	public function remove($meaning, array $context = [])
	{
		$meaningId = $meaning->id();
		$command = new DeleteMeaning($meaningId);

		$this->notify(new MeaningHasBeenDeleted($meaningId));

		$this->commandBus->handle($command);
	}
}
