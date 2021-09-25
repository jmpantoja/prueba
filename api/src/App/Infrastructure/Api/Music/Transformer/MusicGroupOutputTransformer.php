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
use App\Domain\Music\MusicGroup;
use App\Infrastructure\Api\Music\Dto\MusicGroupOutput;

final class MusicGroupOutputTransformer implements DataTransformerInterface
{
	/**
	 * @param MusicGroup $musicGroup
	 *
	 * @return object|void
	 */
	public function transform($musicGroup, string $to, array $context = [])
	{
		return MusicGroupOutput::make($musicGroup);
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return MusicGroupOutput::class === $to;
	}
}
