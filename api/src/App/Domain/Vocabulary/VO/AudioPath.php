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

namespace App\Domain\Vocabulary\VO;

use Tangram\Domain\Assertion\Traits\Assert;

final class AudioPath
{
	use Assert;

	private ?string $path;

	public function __construct(?string $path)
	{
		$this->assert($path);

		$this->path = $path;
	}

	public function path(): ?string
	{
		return $this->path;
	}

	public function __toString(): string
	{
		return (string) $this->path();
	}
}
