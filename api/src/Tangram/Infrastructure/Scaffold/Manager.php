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

use Symfony\Component\Process\Process;

final class Manager
{
	private Renderer $renderer;
	private Resolver $resolver;

	public function __construct(Resolver $resolver, Renderer $renderer)
	{
		$this->resolver = $resolver;
		$this->renderer = $renderer;
	}

	public function generate(Config $config): self
	{
		$context = $this->getContext($config);
		$files = $this->getActions($config);

		$this->renderer->setContext($context);
		foreach ($files as $file) {
			$this->renderer->dump($file);
		}

		$this->fixCodeStyle();

		return $this;
	}

	private function fixCodeStyle()
	{
		$process = new Process(['bin/php-cs-fixer', 'fix']);
		$process->run();
	}

	private function getActions(Config $config): array
	{
		$files = [];
		foreach ($config->definitions() as $definition) {
			$tasks = $this->resolver->resolve($definition);

			$targets = array_map(function (Task $task) {
				return $task->target();
			}, $tasks);

			foreach ($tasks as $task) {
				$files[] = new Action($task, $targets);
			}
		}

		return $files;
	}

	private function getContext(Config $config): array
	{
		$context = [];
		foreach ($config->definitions() as $definition) {
			$tasks = $this->resolver->resolve($definition);

			$main = $tasks['entity'] ?? $tasks['enum'] ?? $tasks['valueObject'];
			$context[$definition->key()] = $main->target();
			$context['dbal_types'][] = $tasks['entityIdType'] ?? $tasks['valueObjectType'] ?? $tasks['enumType'] ?? null;
		}

		return $context;
	}
}
