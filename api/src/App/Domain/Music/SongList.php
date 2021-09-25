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

final class SongList extends EntityList
{
	public function type(): string
	{
		return Song::class;
	}

	public function compareWith(iterable $values): DiffList
	{
		$input = MixedList::collect($values);

		$from = $this->mapKeys([$this, 'hash']);
		$input = $input->mapKeys([$this, 'hash']);

		return DiffList::compare($from, $input);
	}

	public static function hash(Song | Input $song): string
	{
		throw new \Exception(sprintf('Incomplete method "%s"', ...[__METHOD__]));
		//Generar un hash para este objeto / array que sirva como identificador
		//para comparar con otros elementos de esta lista
		//por ejemplo:

		$hash = $song instanceof Song ? $song->name() : $song['name'] ?? '';

		return (string) $hash;
	}
}
