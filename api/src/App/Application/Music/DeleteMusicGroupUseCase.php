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

namespace App\Application\Music;

use App\Domain\Music\Repository\MusicGroupRepository;
use Tangram\Application\UseCase\UseCaseInterface;

final class DeleteMusicGroupUseCase implements UseCaseInterface
{
	private MusicGroupRepository $repository;

	public function __construct(MusicGroupRepository $repository)
	{
		$this->repository = $repository;
	}

	public function handle(DeleteMusicGroup $command)
	{
		$this->repository->delete($command->musicGroupId());
	}
}
