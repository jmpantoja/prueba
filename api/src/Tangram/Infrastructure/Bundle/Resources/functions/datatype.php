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

use Tangram\Domain\VarType\TypeUtils;

if (!function_exists('is_stringable')) {

    /**
     * @param mixed $value
     * @return bool
     */
    function is_stringable($value): bool
    {
        return is_null($value)
            || is_scalar($value)
            || (is_object($value) && method_exists($value, '__toString'));
    }
}


if (!function_exists('is_typeof')) {

    /**
     * @param mixed $value
     * @return bool
     */
    function is_typeof($value, string ...$types): bool
    {
        return TypeUtils::isTypeOf($value, ...$types);
    }
}

if (!function_exists('typeof')) {

    /**
     * @param mixed $value
     * @return bool
     */
    function typeof($value): string
    {
        return TypeUtils::typeOf($value);
    }
}
