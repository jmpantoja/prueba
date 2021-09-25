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
 * @method static EURO()
 * @method static DOLLAR()
 */
final class Currency extends Enum
{
	public const EURO = 'euro';
	public const DOLLAR = 'dollar';
}
