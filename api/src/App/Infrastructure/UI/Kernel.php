<?php

namespace App\Infrastructure\UI;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Tangram\Infrastructure\Bundle\TangramBundle;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function registerBundles(): iterable
    {
        $contents = require $this->getProjectDir() . '/config/bundles.php';
        $contents[TangramBundle::class] = ['all' => true];
        foreach ($contents as $class => $envs) {
            if ($envs[$this->environment] ?? $envs['all'] ?? false) {
                yield new $class();
            }
        }
    }

    public function getProjectDir(): string
    {
        return realpath(__DIR__ . '/../../../../');
    }

    public function getCacheDir()
    {
        return parent::getCacheDir();
    }


    protected function configureContainer(ContainerConfigurator $container): void
    {
        AnnotationReader::addGlobalIgnoredName('alias');

        $confDir = $this->getProjectDir() . '/config';

        $container->import($confDir . '/{packages}/*.yaml');
        $container->import($confDir . '/{packages}/' . $this->environment . '/*.yaml');

        if (is_file($confDir . '/services.yaml')) {
            $container->import($confDir . '/{services}.yaml');
            $container->import($confDir . '/{services}_' . $this->environment . '.yaml');
        } elseif (is_file($path = $confDir . '/services.php')) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $confDir = $this->getProjectDir() . '/config';

        $routes->import($confDir . '/{routes}/' . $this->environment . '/*.yaml');
        $routes->import($confDir . '/{routes}/*.yaml');

        if (is_file($confDir . '/routes.yaml')) {
            $routes->import($confDir . '/{routes}.yaml');
        } elseif (is_file($path = $confDir . '/config/routes.php')) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
