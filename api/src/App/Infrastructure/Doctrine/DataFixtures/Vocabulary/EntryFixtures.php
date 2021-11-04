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
use App\Domain\Vocabulary\Entry;
use App\Domain\Vocabulary\Input\MeaningInput;
use App\Domain\Vocabulary\VO\Deep;
use App\Domain\Vocabulary\VO\EntryType;
use App\Domain\Vocabulary\VO\Lang;
use App\Domain\Vocabulary\VO\Level;
use App\Domain\Vocabulary\VO\Term;
use Tangram\Infrastructure\Doctrine\DataFixtures\UseCaseFixture;

final class EntryFixtures extends UseCaseFixture
{
    public function loadData(): void
    {
        $items = $this->createMany(100, function () {
            return new Entry(...[
                'type' => EntryType::WORD(),
                'term' => new Term($this->faker->word, Lang::ENGLISH()),
                'level' => new Level(1, 1),
                'meanings' => [
                    MeaningInput::fromArray([
                        'term' => new Term($this->faker->word, Lang::SPANISH()),
                        'deep' => new Deep(1),
                    ]),
                    MeaningInput::fromArray([
                        'term' => new Term($this->faker->word, Lang::SPANISH()),
                        'deep' => new Deep(2),
                    ])
                ],
            ]);
        });

        foreach ($items as $entry) {
            $this->handle(new SaveEntry($entry));
        }
    }
}
