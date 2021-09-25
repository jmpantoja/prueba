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

use App\Domain\Music\Repository\AlbumRepository;
use Tangram\Application\UseCase\UseCaseInterface;

final class SaveAlbumUseCase implements UseCaseInterface
{
	private AlbumRepository $repository;

	public function __construct(AlbumRepository $repository)
	{
		$this->repository = $repository;
	}

	public function handle(SaveAlbum $command)
	{
		$this->repository->save($command->album());
	}
}
