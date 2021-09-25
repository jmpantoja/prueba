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

namespace App\Domain\Music\VO;

use MyCLabs\Enum\Enum;

/**
 * @method static SPAIN()
 * @method static USA()
 * @method static UK()
 */
final class Country extends Enum
{
	public const SPAIN = 'Spain';
	public const USA = 'USA';
	public const UK = 'UK';
}
