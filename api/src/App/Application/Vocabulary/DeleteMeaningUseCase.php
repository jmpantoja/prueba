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

use App\Domain\Vocabulary\Repository\MeaningRepository;
use Tangram\Application\UseCase\UseCaseInterface;

final class DeleteMeaningUseCase implements UseCaseInterface
{
	private MeaningRepository $repository;

	public function __construct(MeaningRepository $repository)
	{
		$this->repository = $repository;
	}

	public function handle(DeleteMeaning $command)
	{
		$this->repository->delete($command->meaningId());
	}
}
