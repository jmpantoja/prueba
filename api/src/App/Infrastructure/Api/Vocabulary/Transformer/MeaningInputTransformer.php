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

namespace App\Infrastructure\Api\Vocabulary\Transformer;

use ApiPlatform\Core\DataTransformer\DataTransformerInterface;
use ApiPlatform\Core\Validator\ValidatorInterface;
use App\Domain\Vocabulary\Input\MeaningInput;
use App\Domain\Vocabulary\Meaning;
use App\Domain\Vocabulary\Repository\MeaningRepository;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class MeaningInputTransformer implements DataTransformerInterface
{
	private ValidatorInterface $validator;
	private MeaningRepository $repository;

	public function __construct(ValidatorInterface $validator, MeaningRepository $repository)
	{
		$this->validator = $validator;
		$this->repository = $repository;
	}

	/**
	 * @param MeaningInput $input
	 *
	 * @return object|void
	 */
	public function transform($input, string $to, array $context = [])
	{
		$this->validator->validate($input, $context);

		$meaning = $this->findEntity($context);
		$data = (array) $input;

		if (null === $meaning) {
			return new Meaning(...$data);
		}

		unset($data['entry']);

		$meaning->update(...$data);

		return $meaning;
	}

	private function findEntity(array $context): ?Meaning
	{
		$meaning = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
		if ($meaning instanceof Meaning) {
			return $meaning;
		}

		return null;
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return Meaning::class === $to;
	}
}
