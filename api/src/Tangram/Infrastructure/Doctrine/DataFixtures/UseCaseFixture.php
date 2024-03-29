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

namespace Tangram\Infrastructure\Doctrine\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Iterator;
use League\Tactician\CommandBus;
use Symfony\Component\Validator\Constraints\Range;

abstract class UseCaseFixture extends Fixture
{
    /**
     * @var CommandBus
     */
    private CommandBus $commandBus;
    protected Generator $faker;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
        $this->faker = Factory::create();
    }

    public function load(ObjectManager $manager)
    {
        $this->loadData();
    }

    public function handle(object $command)
    {
        $this->commandBus->handle($command);
    }

    abstract public function loadData(): void;

    protected function createMany(int $count, callable $callback): Iterator
    {
        return $this->createRange(range(1, $count), $callback);
    }

    protected function createRange(array $range, callable $callback): Iterator
    {
        foreach ($range as $index => $data) {
            $entity = $callback($data, $index);
            $this->addReference(get_class($entity) . '_' . $index, $entity);
            yield $entity;
        }
    }

}
