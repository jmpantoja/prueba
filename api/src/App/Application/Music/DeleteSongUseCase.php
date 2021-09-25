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

use App\Domain\Music\Repository\SongRepository;
use Tangram\Application\UseCase\UseCaseInterface;

final class DeleteSongUseCase implements UseCaseInterface
{
	private SongRepository $repository;

	public function __construct(SongRepository $repository)
	{
		$this->repository = $repository;
	}

	public function handle(DeleteSong $command)
	{
		$this->repository->delete($command->songId());
	}
}
