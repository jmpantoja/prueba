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

final class Term
{
	use Assert;

	private string $term;

	private Lang $lang;

	public function __construct(string $term, Lang $lang)
	{
		$this->assert(get_defined_vars());

		$this->term = $term;
		$this->lang = $lang;
	}

	public function term(): string
	{
		return $this->term;
	}

	public function lang(): Lang
	{
		return $this->lang;
	}
}
