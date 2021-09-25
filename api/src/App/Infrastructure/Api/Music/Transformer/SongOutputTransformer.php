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
use App\Domain\Music\Song;
use App\Infrastructure\Api\Music\Dto\SongOutput;

final class SongOutputTransformer implements DataTransformerInterface
{
	/**
	 * @param Song $song
	 *
	 * @return object|void
	 */
	public function transform($song, string $to, array $context = [])
	{
		return SongOutput::make($song);
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return SongOutput::class === $to;
	}
}
