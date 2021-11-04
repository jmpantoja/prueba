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

namespace App\Application\Vocabulary;

use App\Domain\Vocabulary\Repository\EntryRepository;
use Tangram\Application\UseCase\UseCaseInterface;

final class DeleteEntryUseCase implements UseCaseInterface
{
	private EntryRepository $repository;

	public function __construct(EntryRepository $repository)
	{
		$this->repository = $repository;
	}

	public function handle(DeleteEntry $command)
	{
		$this->repository->delete($command->entryId());
	}
}
