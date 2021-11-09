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

final class Level
{
	use Assert;

	public const MAX_LEVEL = 20;
	public const MAX_PAGE = 100;

	private int $level;
	private int $page;

	public function __construct(int $level, int $page)
	{
		$this->assert([
			'level' => $level,
			'page' => $page,
		]);

		$this->level = $level;
		$this->page = $page;
	}

	public function level(): int
	{
		return $this->level;
	}

	public function page(): int
	{
		return $this->page;
	}

	public function key()
	{
		return sprintf('K%02s%02s', $this->level, $this->page);
	}

	public function next(): ?Level
	{
		$level = $this->level;
		$page = $this->page;

		++$page;
		if ($page > self::MAX_PAGE) {
			$page = 1;
			++$level;
		}

		if ($level > self::MAX_LEVEL) {
			return null;
		}

		return new self($level, $page);
	}
}
