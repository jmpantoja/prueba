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

namespace App\Domain\Vocabulary\VO;

use MyCLabs\Enum\Enum;

/**
 * @method static WORD()
 * @method static PHRASAL_VERB()
 * @method static COLLOCATION()
 */
final class EntryType extends Enum
{
	public const WORD = 'word';
	public const PHRASAL_VERB = 'phrasal_verb';
	public const COLLOCATION = 'collocation';
}
