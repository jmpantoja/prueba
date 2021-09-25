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

namespace App\Infrastructure\Api\Music\Transformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Domain\Music\Repository\SongRepository;
use App\Domain\Music\Song;
use App\Infrastructure\Api\Music\Dto\SongInput;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class SongInputTransformer implements DataTransformerInterface
{
	private ValidatorInterface $validator;
	private SongRepository $repository;

	public function __construct(ValidatorInterface $validator, SongRepository $repository)
	{
		$this->validator = $validator;
		$this->repository = $repository;
	}

	/**
	 * @param SongInput $input
	 *
	 * @return object|void
	 */
	public function transform($input, string $to, array $context = [])
	{
		$this->validator->validate($input, $context);

		$song = $this->findEntity($context);
		$data = (array) $input;

		if (null === $song) {
			return new Song(...$data);
		}

		$song->update(...$data);

		return $song;
	}

	private function findEntity(array $context): ?Song
	{
		$song = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
		if ($song instanceof Song) {
			return $song;
		}

		return null;
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return Song::class === $to;
	}
}
