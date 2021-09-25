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

final class MusicGroupList extends EntityList
{
	public function type(): string
	{
		return MusicGroup::class;
	}

	public function compareWith(iterable $values): DiffList
	{
		$input = MixedList::collect($values);

		$from = $this->mapKeys([$this, 'hash']);
		$input = $input->mapKeys([$this, 'hash']);

		return DiffList::compare($from, $input);
	}

	public static function hash(MusicGroup | Input $musicGroup): string
	{
		throw new \Exception(sprintf('Incomplete method "%s"', ...[__METHOD__]));
		//Generar un hash para este objeto / array que sirva como identificador
		//para comparar con otros elementos de esta lista
		//por ejemplo:

		$hash = $musicGroup instanceof MusicGroup ? $musicGroup->name() : $musicGroup['name'] ?? '';

		return (string) $hash;
	}
}
