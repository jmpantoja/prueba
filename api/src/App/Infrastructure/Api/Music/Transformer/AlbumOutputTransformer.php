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
use App\Domain\Music\Album;
use App\Infrastructure\Api\Music\Dto\AlbumOutput;

final class AlbumOutputTransformer implements DataTransformerInterface
{
	/**
	 * @param Album $album
	 *
	 * @return object|void
	 */
	public function transform($album, string $to, array $context = [])
	{
		return AlbumOutput::make($album);
	}

	public function supportsTransformation($data, string $to, array $context = []): bool
	{
		return AlbumOutput::class === $to;
	}
}
