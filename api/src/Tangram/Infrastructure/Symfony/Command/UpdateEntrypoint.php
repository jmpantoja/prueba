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

namespace Tangram\Infrastructure\Symfony\Command;


use Symfony\Bundle\MakerBundle\ConsoleStyle;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Tangram\Infrastructure\Symfony\Boilerplate\EntityCreator;
use Tangram\Infrastructure\Symfony\Boilerplate\EntityCreatorFactory;

final class UpdateEntrypoint extends Command
{
    protected static $defaultName = 'tangram:update:entrypoint';
    /**
     * @var EntityCreatorFactory
     */
    private EntityCreatorFactory $factory;

    public function __construct(EntityCreatorFactory $factory)
    {
        parent::__construct(static::$defaultName);
        $this->factory = $factory;
    }

    protected function configure()
    {
        $this->addArgument('entityName', InputArgument::REQUIRED, 'Class name of the entity to create or update');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $entityName = (string)$input->getArgument('entityName');
        $console = new ConsoleStyle($input, $output);

        /** @var EntityCreator $creator */
        $creator = call_user_func($this->factory, $console, $entityName);

        $creator->createClass('input', true);
        $creator->createClass('input-transformer', true);
        $creator->createFile('serialize-mapping', true);

        $creator->writeChanges();

        return Command::SUCCESS;
    }
}
