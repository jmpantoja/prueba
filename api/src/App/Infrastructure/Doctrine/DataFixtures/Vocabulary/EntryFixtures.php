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

namespace App\Infrastructure\Doctrine\DataFixtures\Vocabulary;

use App\Application\Vocabulary\SaveEntry;
use Tangram\Infrastructure\Doctrine\DataFixtures\SqlFileFixture;

final class EntryFixtures extends SqlFileFixture
{
    public function loadData(): void
    {


        $content = '';
        $stmt = $this->get('doctrine.orm.entity_manager')->getConnection()->prepare($content);


        $items = $this->createMany(100, function () {
            /*
            return new Entry(...[
                'type' => $type,
                'term' => $term,
                'level' => $level,
                'audio' => $audio,
                'meanings' => $meanings,
            ]);
            */
        });

        foreach ($items as $entry) {
            $this->handle(new SaveEntry($entry));
        }
    }

    protected function getSqlFiles(): string|array
    {
        return sprintf('%s/data/entries.sql', __DIR__);
    }
}
