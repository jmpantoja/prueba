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
use Tangram\Domain\Lists\DiffList;
use Tangram\Domain\Lists\EntityList;
use Tangram\Domain\Lists\MixedList;

final class MeaningList extends EntityList
{
    public function type(): string
    {
        return Meaning::class;
    }

    public function compareWith(iterable $values): DiffList
    {
        $input = MixedList::collect($values);

        $from = $this->mapKeys([$this, 'hash']);
        $input = $input->mapKeys([$this, 'hash']);

        return DiffList::compare($from, $input);
    }

    public static function hash(Meaning|MeaningInput $meaning): string
    {
        $term = $meaning->term();

        return sprintf('%s-%s', $term->term(), $term->lang());
    }
}
