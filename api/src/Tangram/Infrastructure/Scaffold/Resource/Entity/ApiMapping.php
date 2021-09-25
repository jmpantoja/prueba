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

use Tangram\Infrastructure\Scaffold\Model\Model;
use Tangram\Infrastructure\Scaffold\Resource\FileOptions;
use Tangram\Infrastructure\Scaffold\Resource\FileResource;

final class ApiMapping extends FileResource
{
	public function supports(Model $model): bool
	{
		return $model->isEndpoint();
	}

	public function configure(FileOptions $options, string $name, string $module)
	{
		$options->setTarget('config/mapping/api_platform');
		$options->setFileName($module, $name, 'yaml');
		$options->setTemplate('api-mapping.yaml');
	}
}
