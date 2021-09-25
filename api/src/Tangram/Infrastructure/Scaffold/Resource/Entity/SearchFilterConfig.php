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

namespace Tangram\Infrastructure\Scaffold\Resource\Entity;

use function Symfony\Component\String\u;
use Tangram\Infrastructure\Scaffold\Model\Model;
use Tangram\Infrastructure\Scaffold\Resource\FileOptions;
use Tangram\Infrastructure\Scaffold\Resource\FileResource;

final class SearchFilterConfig extends FileResource
{
	public function supports(Model $model): bool
	{
		return $model->isEndpoint();
	}

	public function configure(FileOptions $options, string $name, string $module)
	{
		$module = strtolower($module);
		$name = u($name)->snake()->toString();

		$options->setTarget('config/filters/'.$module);
		$options->setFileName($name, 'filter', 'yaml');
		$options->setTemplate('filter.yaml');
	}
}
