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

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Tangram\Infrastructure\Scaffold\Model\Model;
use Tangram\Infrastructure\Scaffold\Resource\ClassOptions;
use Tangram\Infrastructure\Scaffold\Resource\ClassResource;
use Tangram\Infrastructure\Scaffold\Task;

final class ClassResolver
{
	private string $sourceDir;

	public function __construct(ParameterBagInterface $parameterBag)
	{
		$this->sourceDir = sprintf('%s/src', $parameterBag->get('kernel.project_dir'));
		$this->testDir = sprintf('%s/tests', $parameterBag->get('kernel.project_dir'));
	}

	public function resolve(ClassResource $resource, Model $model): Task
	{
		$options = new ClassOptions($model->prefix());
		$resource->configure($options, $model->name(), $model->module());

		$path = $this->calculePath($options);
		$vars = Target::model($options->fqn(), $model);

		return new Task($path, $options->template(), $vars, $options->isUpdatable());
	}

	private function calculePath(ClassOptions $options): string
	{
		$dirname = $this->sourceDir;
		if ($options->isTest()) {
			$dirname = $this->testDir;
		}

		$path = sprintf('%s/%s/%s.php', ...[
			$dirname,
			$options->namespace(),
			$options->className(),
		]);

		return str_replace('\\', '/', $path);
	}
}
