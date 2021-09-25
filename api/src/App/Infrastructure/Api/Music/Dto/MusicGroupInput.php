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

use App\Domain\Music\VO\Country;
use App\Domain\Music\VO\GroupName;
use Tangram\Infrastructure\Api\Dto\Input;

final class MusicGroupInput extends Input
{
	public GroupName $name;

	public Country $country;

	/**
	 * @var AlbumInput[]
	 */
	public array $albums;
}
