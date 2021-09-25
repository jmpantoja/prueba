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
use App\Domain\Music\Album;
use App\Domain\Music\Repository\AlbumRepository;
use App\Infrastructure\Api\Music\Dto\AlbumInput;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class AlbumInputTransformer implements DataTransformerInterface
{
	private ValidatorInterface $validator;
	private AlbumRepository $repository;

	public function __construct(ValidatorInterface $validator, AlbumRepository $repository)
	{
		$this->validator = $validator;
		$this->repository = $repository;
	}

	/**
	 * @param AlbumInput $input
	 *
	 * @return object|void
	 */
	public function transform($input, string $to, array $context = [])
	{
		$this->validator->validate($input, $context);

		$album = $this->findEntity($context);
		$data = (array) $input;

		if (null === $album) {

			return new Album(...$data);
		}

		$album->update(...$data);

		return $album;
	}

	private function findEntity(array $context): ?Album
	{
		$album = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
		if ($album instanceof Album) {
			return $album;
		}

		return null;
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return Album::class === $to;
	}
}
