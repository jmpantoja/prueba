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

use App\Application\Vocabulary\SaveMeaning;
use App\Domain\Vocabulary\Meaning;
use Tangram\Infrastructure\Doctrine\DataFixtures\UseCaseFixture;

final class MeaningFixtures extends UseCaseFixture
{
	public function loadData(): void
	{
		$items = $this->createMany(100, function () {
			/*
			return new Meaning(...[
				'entry' => $entry,
				'term' => $term,
				'deep' => $deep,
			]);
			*/
		});

		foreach ($items as $meaning) {
			$this->handle(new SaveMeaning($meaning));
		}
	}
}
