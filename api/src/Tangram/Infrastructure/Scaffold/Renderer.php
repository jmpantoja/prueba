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

use Symfony\Component\Filesystem\Filesystem;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

final class Renderer
{
	private Filesystem $fileSystem;
	private Environment $twig;
	private array $dbalTypes = [];

	public function __construct()
	{
		$loader = new FilesystemLoader(sprintf('%s/_templates', __DIR__));

		$this->fileSystem = new Filesystem();
		$this->twig = new Environment($loader, [
			'cache' => realpath('./var/cache/dev/twig'),
			'debug' => true,
		]);
	}

	public function dump(Action $task, bool $force)
	{
		$path = $task->path();
		if (file_exists($path) && !$task->isUpdatable() && false === $force) {
			return;
		}

		$template = $task->template();
		$vars = $task->vars();
		$vars['dbal_types'] = $this->dbalTypes;

		$content = $this->twig->render($template, $vars);
		$this->fileSystem->dumpFile($path, $content);
	}

	public function setContext(array $context): self
	{
		$this->twig->addExtension(new TwigExtension($context));

		$this->dbalTypes = array_map(function (Task $task) {
			return $task->target();
		}, array_filter($context['dbal_types']));

		return $this;
	}
}
