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
use Tangram\Infrastructure\Scaffold\Resource\ClassOptions;
use Tangram\Infrastructure\Scaffold\Resource\ClassResource;

final class DeleteCommand extends ClassResource
{
	public function supports(Model $model): bool
	{
		return $model->isEndpoint();
	}

	public function configure(ClassOptions $options, string $name, string $module)
	{
		$options->setNamespace('Application', $module);
		$options->setClassName('Delete', $name);
		$options->setTemplate('delete-command');
	}
}
