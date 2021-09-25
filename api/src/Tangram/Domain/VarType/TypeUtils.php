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

namespace Tangram\Domain\VarType;

final class TypeUtils
{
	public const NULL = 'null';
	public const RESOURCE = 'resource';
	public const BOOL = 'bool';
	public const INT = 'int';
	public const LONG = 'long';
	public const INTEGER = 'integer';
	public const FLOAT = 'float';
	public const DOUBLE = 'double';
	public const REAL = 'double';
	public const NUMERIC = 'numeric';
	public const STRING = 'string';
	public const ARRAY = 'array';
	public const OBJECT = 'object';
	public const SCALAR = 'scalar';
	public const CALLABLE = 'callable';
	public const COUNTABLE = 'countable';
	public const STRINGABLE = 'stringable';
	public const ITERABLE = 'iterable';

	private const NATIVES = [
		'bool',
		'float',
		'int',
		'string',
		'array',
		'object',
		'callable',
	];

	/**
	 * @param mixed  $value
	 * @param string $type
	 */
	public static function isTypeOf($value, string ...$types): bool
	{
		$matched = false;

		foreach ($types as $type) {
			$function = sprintf('is_%s', strtolower($type));
			$matched = $matched || (function_exists($function) ? call_user_func($function, $value) : is_a($value, $type));
		}

		return $matched;
	}

	public static function typeOf($value): string
	{
		if (is_object($value)) {
			return $value::class;
		}

		return gettype($value);
	}

	public static function isNative(string $type): bool
	{
		return in_array(strtolower($type), self::NATIVES);
	}
}
