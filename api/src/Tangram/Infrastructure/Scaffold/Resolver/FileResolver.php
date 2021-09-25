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

namespace Tangram\Infrastructure\Scaffold\Resolver;

use Tangram\Infrastructure\Scaffold\Model\Model;
use Tangram\Infrastructure\Scaffold\Resource\FileOptions;
use Tangram\Infrastructure\Scaffold\Resource\FileResource;
use Tangram\Infrastructure\Scaffold\Task;

final class FileResolver
{
	public function resolve(FileResource $resource, Model $model)
	{
		$options = new FileOptions();
		$resource->configure($options, $model->name(), $model->module());

		$path = sprintf('%s/%s', $options->target(), $options->fileName());

		return new Task($path, $options->template(), null, $options->isUpdatable());
	}
}
