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

namespace App\Infrastructure\Doctrine\DataFixtures\Music;

use App\Application\Music\SaveSong;
use App\Domain\Music\Song;
use Tangram\Infrastructure\Doctrine\DataFixtures\UseCaseFixture;

final class SongFixtures extends UseCaseFixture
{
	public function loadData(): void
	{
		$items = $this->createMany(100, function () {
			//return new Song();
		});

		foreach ($items as $song) {
			$this->handle(new SaveSong($song));
		}
	}
}
