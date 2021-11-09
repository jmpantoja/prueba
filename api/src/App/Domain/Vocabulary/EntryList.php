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
use Tangram\Domain\Lists\EntityList;
use Tangram\Infrastructure\Api\Dto\Input;

final class EntryList extends EntityList
{
	public function type(): string
	{
		return Entry::class;
	}

	public static function hash(Input|Entry|EntryInput $entry): string
	{
		$term = $entry->term();

		return sprintf('%s-%s', $term->term(), $term->lang());
	}
}
