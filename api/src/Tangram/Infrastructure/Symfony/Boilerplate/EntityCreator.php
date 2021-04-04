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


use Laminas\Filter\Word\SeparatorToCamelCase;
use ReflectionClass;
use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Bundle\MakerBundle\FileManager;
use Symfony\Bundle\MakerBundle\Generator;
use Symfony\Bundle\MakerBundle\Str;

class EntityCreator
{
    /**
     * @var Generator
     */
    private Generator $generator;

    /**
     * @var FileManager
     */
    private FileManager $fileManager;

    /**
     * @var array
     */
    private array $classes = [];
    /**
     * @var array
     */
    private array $variables = [];
    private array $files = [];

    private string $name;
    /**
     * @var ConsoleStyle
     */
    private ConsoleStyle $console;
    private string $projectDir;

    public function __construct(FileManager $fileManager, ConsoleStyle $console, string $name, string $namespace, string $projectDir)
    {
        $this->fileManager = $fileManager;
        $this->console = $console;
        $this->projectDir = $projectDir;

        $this->generator = new Generator($this->fileManager, $namespace);
        $this->name = $name;

        $this->configure();

        $this->initVars();
    }

    protected function configure()
    {
        $this->addFile('api-mapping', function (CreateFileOptions $options, $name, $module) {
            $options->setTarget('config/mapping/api_platform');
            $options->setFileName($module, $name, 'yaml');
        });

        $this->addFile('serialize-mapping', function (CreateFileOptions $options, $name, $module) {
            $options->setTarget('config/mapping/serialization');
            $options->setFileName($module, $name, 'yaml');
        });

        $this->addClass('entity', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Domain', $module);
            $options->setClassName($name);
        });

        $this->addClass('entity-id', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Domain', $module);
            $options->setClassName($name, 'Id');
        });

        $this->addClass('repository', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Domain', $module);
            $options->setClassName($name, 'Repository');
        });

        $this->addClass('entity-list', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Domain', $module);
            $options->setClassName($name, 'List');
        });

        $this->addClass('create-event', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Domain', $module, 'Event');
            $options->setClassName($name, 'HasBeenCreated');
        });

        $this->addClass('update-event', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Domain', $module, 'Event');
            $options->setClassName($name, 'HasBeenUpdated');
        });

        $this->addClass('delete-event', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Domain', $module, 'Event');
            $options->setClassName($name, 'HasBeenDeleted');
        });

        $this->addClass('save-command', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Application', $module);
            $options->setClassName('Save', $name);
        });

        $this->addClass('save-usecase', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Application', $module);
            $options->setClassName('Save', $name, 'UseCase');
        });

        $this->addClass('delete-command', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Application', $module);
            $options->setClassName('Delete', $name);
        });

        $this->addClass('delete-usecase', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Application', $module);
            $options->setClassName('Delete', $name, 'UseCase');
        });

        $this->addClass('input', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Api', $module, 'Dto');
            $options->setClassName($name, 'Input');
        });

        $this->addClass('output', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Api', $module, 'Dto');
            $options->setClassName($name, 'Output');
        });

        $this->addClass('entity-id-type', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Doctrine\\DBAL\\Type');
            $options->setClassName($name, 'IdType');
        });

        $this->addClass('output-transformer', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Api', $module, 'Transformer');
            $options->setClassName($name, 'OutputTransformer');
        });

        $this->addClass('input-transformer', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Api', $module, 'Transformer');
            $options->setClassName($name, 'InputTransformer');
        });

        $this->addClass('repository-doctrine', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Api', $module, 'Repository');
            $options->setClassName($name, 'DoctrineRepository');
        });

        $this->addClass('persister', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Api', $module, 'Persister');
            $options->setClassName($name, 'Persister');
        });

        $this->addClass('normalizer', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Api', $module, 'Normalizer');
            $options->setClassName($name, 'Normalizer');
        });

        $this->addClass('fixtures', function (CreateClassOptions $options, $name, $module) {
            $options->setNamespace('Infrastructure\\Doctrine\\DataFixtures', $module);
            $options->setClassName($name, 'Fixtures');
        });


    }


    /**
     * @param string $key
     * @return array|string
     */
    private function normalize(string $key)
    {
        $filter = new SeparatorToCamelCase('-');
        $name = $filter->filter($key);
        return lcfirst($name);
    }

    private function addClass(string $key, callable $configurator)
    {
        list($module, $name) = explode('\\', $this->name);
        $options = new CreateClassOptions($name, $module);
        $configurator($options, $name, $module);

        $details = $this->generator->createClassNameDetails($options->className(), $options->namespace());

        $fullName = $details->getFullName();
        $shortName = $details->getShortName();
        $target = $this->fileManager->getRelativePathForFutureClass($fullName);
        $template = sprintf('%s/templates/%s.tpl.php', __DIR__, $key);


        $varName = $this->normalize($key);

        $this->classes[$varName] = [
            'fullName' => $fullName,
            'shortName' => $shortName,
            'target' => $target,
            'template' => $template,
            'varName' => lcfirst($shortName)
        ];
    }

    private function addFile(string $key, callable $configurator)
    {

        list($module, $name) = explode('\\', $this->name);
        $options = new CreateFileOptions($name, $module);

        $configurator($options, $name, $module);
        $template = sprintf('%s/templates/%s.tpl.php', __DIR__, $key);

        $varName = $this->normalize($key);

        $this->files[$varName] = [
            'target' => sprintf('%s/%s/%s', $this->projectDir, $options->target(), $options->fileName()),
            'template' => $template
        ];
    }

    public function createClass(string $key, bool $overwrite = false)
    {
        $name = $this->normalize($key);

        $class = $this->classes[$name];
        $target = $class['target'];

        if ($this->skip($target, $overwrite)) {
            return;
        }

        $this->generator->generateClass($class['fullName'], $class['template'], $this->variables());
    }

    public function createFile(string $key, bool $overwrite = false)
    {
        $name = $this->normalize($key);

        $file = $this->files[$name];
        $target = $file['target'];

        if ($this->skip($target, $overwrite)) {
            return;
        }

        $this->generator->generateFile($file['target'], $file['template'], $this->variables());
    }

    private function skip(?string $path, bool $overwrite): bool
    {
        if (!$overwrite) {
            return $this->fileManager->fileExists($path);
        }

        if (!$this->fileManager->fileExists($path)) {
            return false;
        }

        $question = sprintf('El fichero "%s" ya existe, desea sobreescribirlo?', $path);
        $response = $this->console->confirm($question, true);

        if ($response) {
            unlink($path);
        }

        return !$response;
    }

    public function writeChanges()
    {
        $this->generator->writeChanges();
    }

    private function variables()
    {
        return $this->variables + $this->classes;
    }

    public function allClasses()
    {
        return $this->classes;
    }

    private function initVars()
    {
        $this->initFieldsVar();
        $this->initUsesVar();
//        $this->initConstructorVar();
//        $this->initUpdateVar();
    }

    private function initFieldsVar()
    {
        $fields = [];

        $className = $this->classes['entity']['fullName'];

        $reflection = new ReflectionClass($className);
        foreach ($reflection->getProperties() as $property) {
            $name = $property->getName();
            $reflectionType = $reflection->getProperty($name)->getType();

            if (null === $reflectionType) {
                continue;
            }


            if ($reflectionType->isBuiltin()) {
                $fields[$name] = [
                    'fullName' => null,
                    'shortName' => $reflectionType->getName(),
                    'nullable' => $reflectionType->allowsNull() || $name === 'id'
                ];
            } else {
                $fields[$name] = [
                    'fullName' => $reflectionType->getName(),
                    'shortName' => Str::getShortClassName($reflectionType->getName()),
                    'nullable' => $reflectionType->allowsNull() || $name === 'id'
                ];
            }
        }

        $this->variables['fields'] = $fields;
    }

    private function initUsesVar()
    {
        $fields = $this->variables['fields'];
        $uses = array_map(function ($field) {
            return $field['fullName'];
        }, $fields);

        $uses[] = $this->classes['entity']['fullName'];

        $this->variables['uses'] = array_filter(array_unique(array_values($uses)));
    }

    private function initConstructorVar()
    {
        $arguments = [];
        $className = $this->classes['entity']['fullName'];
        $reflection = new ReflectionClass($className);
        $method = $reflection->getConstructor();

        foreach ($method->getParameters() as $parameter) {
            $name = $parameter->name;
            $arguments[$name] = $parameter->getType()->getName();
        }

        $this->variables['constructor'] = $arguments;
    }

    private function initUpdateVar()
    {
        $arguments = [];
        $className = $this->classes['entity']['fullName'];
        $reflection = new ReflectionClass($className);

        if (!$reflection->hasMethod('update')) {
            $this->variables['update'] = $arguments;
            return;
        }

        $method = $reflection->getMethod('update');

        foreach ($method->getParameters() as $parameter) {
            $name = $parameter->name;
            $arguments[$name] = $parameter->getType()->getName();
        }

        $this->variables['update'] = $arguments;
    }

}
