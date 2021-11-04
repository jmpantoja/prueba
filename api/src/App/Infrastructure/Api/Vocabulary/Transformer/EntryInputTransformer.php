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
use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\Input\EntryInput;
use App\Domain\Vocabulary\Repository\EntryRepository;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

final class EntryInputTransformer implements DataTransformerInterface
{
	private ValidatorInterface $validator;
	private EntryRepository $repository;

	public function __construct(ValidatorInterface $validator, EntryRepository $repository)
	{
		$this->validator = $validator;
		$this->repository = $repository;
	}

	/**
	 * @param EntryInput $input
	 *
	 * @return object|void
	 */
	public function transform($input, string $to, array $context = [])
	{
		$this->validator->validate($input, $context);

		$entry = $this->findEntity($context);
		$data = (array) $input;

		if (null === $entry) {
			return new Entry(...$data);
		}

		$entry->update(...$data);

		return $entry;
	}

	private function findEntity(array $context): ?Entry
	{
		$entry = $context[ObjectNormalizer::OBJECT_TO_POPULATE] ?? null;
		if ($entry instanceof Entry) {
			return $entry;
		}

		return null;
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return Entry::class === $to;
	}
}
