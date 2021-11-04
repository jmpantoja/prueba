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
use App\Domain\Vocabulary\Entry;
use App\Infrastructure\Api\Vocabulary\Output\EntryOutput;

final class EntryOutputTransformer implements DataTransformerInterface
{
	/**
	 * @param Entry $entry
	 *
	 * @return object|void
	 */
	public function transform($entry, string $to, array $context = [])
	{
		return EntryOutput::make($entry);
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return EntryOutput::class === $to;
	}
}
