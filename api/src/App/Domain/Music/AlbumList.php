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

namespace App\Domain\Music;

use Tangram\Domain\Lists\DiffList;
use Tangram\Domain\Lists\EntityList;
use Tangram\Domain\Lists\MixedList;
use Tangram\Infrastructure\Api\Dto\Input;

final class AlbumList extends EntityList
{
	public function type(): string
	{
		return Album::class;
	}

	public function compareWith(iterable $values): DiffList
	{
		$input = MixedList::collect($values);

		$from = $this->mapKeys([$this, 'hash']);
		$input = $input->mapKeys([$this, 'hash']);

		return DiffList::compare($from, $input);
	}

	public static function hash(Album | Input $album): string
	{
		$hash = $album instanceof Album ? $album->name() : $album['name'] ?? '';

		return (string) $hash;
	}
}
