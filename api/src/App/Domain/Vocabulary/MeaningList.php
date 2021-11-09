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

use App\Domain\Vocabulary\Input\MeaningInput;
use Tangram\Domain\Lists\EntityList;
use Tangram\Infrastructure\Api\Dto\Input;

final class MeaningList extends EntityList
{
	public function type(): string
	{
		return Meaning::class;
	}

	public static function hash(Input|Meaning|MeaningInput $meaning): string
	{
		$term = $meaning->term();

		return sprintf('%s-%s', $term->term(), $term->lang());
	}
}
