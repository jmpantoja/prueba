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

namespace Tangram\Domain\Assertion;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validation;
use Tangram\Domain\Assertion\Exception\AssertException;
use Tangram\Domain\Assertion\Exception\ConstraintNotFound;

class Assertion
{
	/**
	 * @var Constraint[]
	 */
	private array $constraints;

	private function __construct(string $className)
	{
		$constraint = $this->buildConstraint($className);
		$constraints = [$constraint];

		$this->constraints = $constraints;
	}

	private function buildConstraint(string $className): Constraint
	{
		$candidates = $this->candidates($className);

		foreach ($candidates as $constraintName) {
			if (class_exists($constraintName)) {
				return new $constraintName();
			}
		}

		throw new ConstraintNotFound($candidates);
	}

	private function candidates(string $className): array
	{
		$candidates = [];

		$pieces = explode('\\', $className);
		$last = array_pop($pieces);

		//al mismo nivel
		$pieces[] = 'Constraint';
		$pieces[] = $last;
		$candidates[] = implode('\\', $pieces);

		//un nivel por arriba
		array_pop($pieces);
		array_pop($pieces);
		array_pop($pieces);
		$pieces[] = 'Constraint';
		$pieces[] = $last;
		$candidates[] = implode('\\', $pieces);

		return $candidates;
	}

	/**
	 * @return Assertion
	 */
	public static function make(string $className)
	{
		return new self($className);
	}

	public function assert($value): void
	{
		$violationsList = Validation::createValidator()
			->validate($value, $this->constraints);

		if ($violationsList->count() > 0) {
			throw new AssertException($violationsList);
		}
	}
}
