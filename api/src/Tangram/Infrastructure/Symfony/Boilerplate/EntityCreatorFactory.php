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

namespace Tangram\Infrastructure\Symfony\Boilerplate;


use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\FileManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBag;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class EntityCreatorFactory
{
    /**
     * @var FileManager
     */
    private FileManager $fileManager;
    /**
     * @var ParameterBagInterface
     */
    private ParameterBagInterface $parameterBag;

    public function __construct(FileManager $fileManager, ParameterBagInterface $parameterBag)
    {
        $this->fileManager = $fileManager;
        $this->parameterBag = $parameterBag;
    }

    public function __invoke(ConsoleStyle $console, string $name, string $namespace = 'App')
    {
        $projectDir = $this->parameterBag->get('kernel.project_dir');
        return new EntityCreator($this->fileManager, $console, $name, $namespace, $projectDir);
    }
}
