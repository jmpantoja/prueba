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

    /**
     * @param string $className
     * @param Constraint ...$constraints
     * @return Assertion
     */
    public static function make(string $className, Constraint ...$constraints)
    {
        return new self($className, ...$constraints);
    }

    private function __construct(string $className, Constraint ...$constraints)
    {
        if (empty($constraints)) {
            $constraint = $this->buildConstraint($className);
            $constraints = [$constraint];
        }

        $this->constraints = $constraints;
    }

    private function buildConstraint(string $className): Constraint
    {
        $pieces = explode('\\', $className);
        $last = array_pop($pieces);
        $pieces[] = 'Constraint';
        $pieces[] = $last;
        $constraintName = implode('\\', $pieces);

        if (!class_exists($constraintName)) {
            throw new ConstraintNotFound($constraintName);
        }

        return new $constraintName();
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
