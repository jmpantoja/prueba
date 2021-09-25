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

namespace Tangram\Infrastructure\Bundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\PrependExtensionInterface;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Finder\Finder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Yaml\Yaml;
use Tangram\Application\UseCase\UseCaseInterface;

final class TangramExtension extends Extension implements PrependExtensionInterface
{
	public function load(array $configs, ContainerBuilder $container)
	{
		$container->registerForAutoconfiguration(UseCaseInterface::class)
			->addTag('tactician.handler', [
				'typehints' => true,
			]);

		$configDir = dirname(__DIR__).'/Resources/config';

		$loader = new YamlFileLoader(
			$container,
			new FileLocator($configDir)
		);

		$env = $container->getParameter('kernel.environment');
		$loader->load('services.yaml');

		$path = "$configDir/services_$env.yaml";
		if (file_exists($path)) {
			$loader->load("services_$env.yaml");
		}
	}

	public function prepend(ContainerBuilder $container)
	{
		$extensions = array_keys($container->getExtensions());
		$pathToPackages = realpath(__DIR__.'/../Resources/config/packages');

		$config = $this->loadPackagesConfig($pathToPackages);

		foreach ($extensions as $extension) {
			if (isset($config[$extension])) {
				$container->prependExtensionConfig($extension, $config[$extension]);
			}
		}
	}

	/**
	 * @return mixed[]
	 */
	private function loadPackagesConfig(string $pathToDir): array
	{
		$finder = new Finder();
		$finder->name('*.yaml')->in($pathToDir);

		$data = [];
		foreach ($finder as $file) {
			$data[] = Yaml::parseFile($file->getPathname());
		}

		return array_merge(...$data);
	}
}
