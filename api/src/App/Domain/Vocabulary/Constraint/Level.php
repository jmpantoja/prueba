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

use App\Domain\Vocabulary\VO\Level as VO_Level;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\Constraints\Compound;
use Symfony\Component\Validator\Constraints\Range;

final class Level extends Compound
{
	protected function getConstraints(array $options): array
	{
		//para VO compuestos
		return [
			new Collection([
				'fields' => [
					'level' => [
						new Range([
							'min' => 1,
							'max' => VO_Level::MAX_LEVEL,
						]),
					],
					'page' => [
						new Range([
							'min' => 1,
							'max' => VO_Level::MAX_PAGE,
						]),
					],
				],
			]),
		];
	}
}
