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

namespace App\Infrastructure\Api\Music\Dto;

use App\Domain\Music\VO\Duration;
use App\Domain\Music\VO\Position;
use App\Domain\Music\VO\SongName;
use Tangram\Infrastructure\Api\Dto\Input;

final class SongInput extends Input
{
	public Position $order;

	public SongName $name;

	public Duration $duration;
}
