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

namespace Tangram\Infrastructure\Scaffold\Resource\VO;

use Tangram\Infrastructure\Scaffold\Model\Model;
use Tangram\Infrastructure\Scaffold\Resource\FileOptions;
use Tangram\Infrastructure\Scaffold\Resource\FileResource;

final class EmbeddableMapping extends FileResource
{
	public function supports(Model $model): bool
	{
		return $model->isValueObject() && $model->isComposed();
	}

	public function configure(FileOptions $options, string $name, string $module)
	{
		$options->setTarget('config/mapping/doctrine');
		$options->setFileName($module, 'VO', $name, 'orm.xml');
		$options->setTemplate('embeddable.xml');
	}
}
