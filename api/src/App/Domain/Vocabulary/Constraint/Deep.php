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

namespace App\Domain\Vocabulary\Constraint;

use Symfony\Component\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Range;

final class Deep extends Compound
{
	protected function getConstraints(array $options): array
	{
		return [
			new Range([
				'min' => 1,
			]),
		];
	}
}
