<?php

/** @noinspection PhpInternalEntityUsedInspection */

/*
 * This file is part of the planb project.
 *
 * (c) jmpantoja <jmpantoja@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Tangram\Infrastructure\Symfony\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Yaml\Yaml;
use Tangram\Infrastructure\Scaffold\Config;
use Tangram\Infrastructure\Scaffold\Manager;

class ScaffoldCommand extends Command
{
	protected static $defaultName = 'scaffold:generate';

	private mixed $projectDir;
	protected Manager $manager;

	public function __construct(ParameterBagInterface $parameterBag, Manager $manager)
	{
		parent::__construct(static::$defaultName);
		$this->projectDir = $parameterBag->get('kernel.project_dir');
		$this->manager = $manager;
	}

	protected function configure()
	{
		$this->addOption('config-file', 'c', InputOption::VALUE_OPTIONAL, 'the config file path', '.scaffold.yaml');
		$this->addOption('namespace', null, InputOption::VALUE_OPTIONAL, 'the namespace', 'App');
		$this->addOption('force', null, InputOption::VALUE_NONE, 'overwrite all');
		//   $this->addOption('force', null, InputOption::VALUE_NONE, 'overwrite all', false);
		$this->addArgument('force', InputArgument::OPTIONAL, 'sss', false);
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$data = Yaml::parseFile(sprintf('%s/.scaffold.yaml', $this->projectDir));

		$force = $input->getOption('force');
		$namespace = $data['namespace'] ?? 'App';
		$modules = $data['modules'] ?? [];

		$config = Config::make($namespace, $modules);

		$this->manager->generate($config, $force);

		return Command::SUCCESS;
	}
}
