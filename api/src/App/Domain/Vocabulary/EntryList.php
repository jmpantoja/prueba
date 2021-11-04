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

namespace App\Domain\Vocabulary;

use App\Domain\Vocabulary\Input\EntryInput;
use Tangram\Domain\Lists\DiffList;
use Tangram\Domain\Lists\EntityList;
use Tangram\Domain\Lists\MixedList;

final class EntryList extends EntityList
{
	public function type(): string
	{
		return Entry::class;
	}

	public function compareWith(iterable $values): DiffList
	{
		$input = MixedList::collect($values);

		$from = $this->mapKeys([$this, 'hash']);
		$input = $input->mapKeys([$this, 'hash']);

		return DiffList::compare($from, $input);
	}

	public static function hash(Entry|EntryInput $entry): string
	{
		throw new \Exception(sprintf('Incomplete method "%s"', ...[__METHOD__]));
		//Generar un hash para este objeto / array que sirva como identificador
		//para comparar con otros elementos de esta lista
		//por ejemplo:

		$hash = $entry->name();

		return (string) $hash;
	}
}
