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

namespace Tangram\Infrastructure\Scaffold\Model;

use MyCLabs\Enum\Enum;

/**
 * @method static BUILTIN()
 * @method static ENUM()
 * @method static VO()
 * @method static ENTITY()
 * @method static ONE_TO_ONE()
 * @method static ONE_TO_MANY()
 * @method static MANY_TO_ONE()
 * @method static MANY_TO_MANY()
 */
final class ModelType extends Enum
{
	public const BUILTIN = 'Builtin';
	public const ENUM = 'Enum';
	public const VO = 'VO';
	public const ENTITY = 'Entity';

	public const ONE_TO_ONE = 'OneToOne';
	public const ONE_TO_MANY = 'OneToMany';
	public const MANY_TO_ONE = 'ManyToOne';
	public const MANY_TO_MANY = 'ManyToMany';

	public function isBuiltin()
	{
		return self::BUILTIN === $this->getValue();
	}

	public function isRelation()
	{
		return in_array($this->getValue(), [
			ModelType::ONE_TO_ONE,
			ModelType::ONE_TO_MANY,
			ModelType::MANY_TO_ONE,
			ModelType::MANY_TO_MANY,
		]);
	}

	public function isToMany()
	{
		return in_array($this->getValue(), [
			ModelType::ONE_TO_MANY,
			ModelType::MANY_TO_MANY,
		]);
	}

	public function isToOne()
	{
		return in_array($this->getValue(), [
			ModelType::MANY_TO_ONE,
			ModelType::ONE_TO_ONE,
		]);
	}

	public function isManyToOne(): bool
	{
		return self::MANY_TO_ONE == $this->getValue();
	}

	public function isManyToMany(): bool
	{
		return self::MANY_TO_MANY == $this->getValue();
	}

	public function isOneToOne(): bool
	{
		return self::ONE_TO_ONE == $this->getValue();
	}

	public function isOneToMany(): bool
	{
		return self::ONE_TO_MANY == $this->getValue();
	}

	public function __toString()
	{
		if ($this->isRelation()) {
			return self::ENTITY;
		}

		return parent::__toString();
	}
}
