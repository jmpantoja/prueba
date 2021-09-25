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
use App\Domain\Music\MusicGroup;
use App\Domain\Music\Repository\MusicGroupRepository;
use App\Infrastructure\Api\Music\Dto\MusicGroupInput;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class MusicGroupInputTransformer implements DataTransformerInterface
{
	private ValidatorInterface $validator;
	private MusicGroupRepository $repository;

	public function __construct(ValidatorInterface $validator, MusicGroupRepository $repository)
	{
		$this->validator = $validator;
		$this->repository = $repository;
	}

	/**
	 * @param MusicGroupInput $input
	 *
	 * @return object|void
	 */
	public function transform($input, string $to, array $context = [])
	{
		$this->validator->validate($input, $context);

		$musicGroup = $this->findEntity($context);
		$data = (array) $input;

		if (null === $musicGroup) {
			return new MusicGroup(...$data);
		}

		return $musicGroup;

		unset($context['object_to_populate']);

		print_r($context);
		print_r(array_keys($context));
		die;

		$musicGroup->update(...$data);

		return $musicGroup;
	}

	private function findEntity(array $context): ?MusicGroup
	{
		$musicGroup = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
		if ($musicGroup instanceof MusicGroup) {
			return $musicGroup;
		}

		return null;
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return MusicGroup::class === $to;
	}
}
