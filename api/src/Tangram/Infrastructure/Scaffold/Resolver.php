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

namespace Tangram\Infrastructure\Scaffold;

use Exception;
use Tangram\Infrastructure\Scaffold\Model\Model;
use Tangram\Infrastructure\Scaffold\Resolver\ClassResolver;
use Tangram\Infrastructure\Scaffold\Resolver\FileResolver;
use Tangram\Infrastructure\Scaffold\Resource\ClassResource;
use Tangram\Infrastructure\Scaffold\Resource\FileResource;
use Tangram\Infrastructure\Scaffold\Resource\Resource;
use Tangram\Infrastructure\Scaffold\Resource\ResourceList;

final class Resolver
{
	private ResourceList $list;
	private ClassResolver $classResolver;
	private FileResolver $fileResolver;

	public function __construct(ClassResolver $classResolver, FileResolver $fileResolver)
	{
		$this->list = ResourceList::create();
		$this->classResolver = $classResolver;
		$this->fileResolver = $fileResolver;
	}

	/**
	 * @return Task[]
	 */
	public function resolve(Model $model): array
	{
		return $this->list->supportedBy($model)
			->map(function (Resource $resource) use ($model) {
				return $this->createTask($resource, $model);
			})
//            ->mapKeys(function (Task $task) use ($model){
//                return $model->key();
//            })
			->toArray();
	}

	private function createTask(Resource $resource, Model $model): Task
	{
		if ($resource instanceof ClassResource) {
			return $this->classResolver->resolve($resource, $model);
		}

		if ($resource instanceof FileResource) {
			return $this->fileResolver->resolve($resource, $model);
		}

		throw new Exception(sprintf('No hay un resolver para resources tipo: "%s"', $resource::class));
	}
}
