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

namespace App\Domain\Music\VO;

use Tangram\Domain\Assertion\Traits\Assert;

final class AlbumName
{
	use Assert;

	private string $name;

	public function __construct(string $name)
	{
		$this->assert(get_defined_vars());

		$this->name = ucfirst($name);
	}

	public function name(): string
	{
		return $this->name;
	}

	public function __toString(): string
	{
		return $this->name();
	}
}
