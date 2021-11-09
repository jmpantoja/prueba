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
use Symfony\Component\Validator\Constraints\Regex;

final class AudioPath extends Compound
{
	protected function getConstraints(array $options): array
	{
		//para VO simples
		return [
			new Regex([
				'pattern' => '#/(.*)\.mp3#',
			]),
		];

		/*
		//para VO compuestos
			return [
				new Collection([
					'fields' => [
						//aqui las constraints
				]
			])
		];
		*/
	}
}
