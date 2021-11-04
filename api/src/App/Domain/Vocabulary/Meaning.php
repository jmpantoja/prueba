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

use App\Domain\Vocabulary\Traits\MeaningBase;
use Tangram\Domain\Model\Entity;
use Tangram\Domain\Model\Traits\NotifyEvents;

class Meaning implements Entity
{
	use NotifyEvents;
	use MeaningBase;
}
