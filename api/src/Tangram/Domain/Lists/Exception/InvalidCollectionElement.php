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

namespace Tangram\Domain\Lists\Exception;


use PlanB\Edge\Domain\VarType\Exception\InvalidTypeException;

class InvalidCollectionElement extends \InvalidArgumentException
{
    /**
     * InvalidTypeException constructor.
     * @param mixed $value
     * @param string $expectedType
     */
    public function __construct(mixed $value, string $expectedType)
    {
        $type = is_object($value) ? get_class($value) : gettype($value);
        $message = $this->message($value, $expectedType, $type);
        parent::__construct($message);
    }

    /**
     * @param mixed $value
     * @param string $expectedType
     * @param string $type
     * @return string
     */
    private function message(mixed $value, string $expectedType, string $type): string
    {
        if (is_stringable($value)) {
            $pattern = 'Esta collección solo admite elementos del tipo "%s", pero se ha pasado un "%s (%s)"';
            $params = [
                $expectedType,
                $type,
                (string)$value
            ];

            return sprintf($pattern, ...$params);
        }
        $pattern = 'Esta collección solo admite elementos del tipo "%s", pero se ha pasado un "%s"';
        $params = [
            $expectedType,
            $type
        ];

        return sprintf($pattern, ...$params);
    }

}
