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
use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;

abstract class SqlFileFixture extends Fixture
{

    private Connection $connection;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->connection = $entityManager->getConnection();
    }

    public function load(ObjectManager $manager)
    {
        $files = (array)$this->getSqlFiles();


        foreach ($files as $file) {
            $this->connection->beginTransaction();
            $sql = file_get_contents($file);
            $this->connection->executeStatement($sql);
        }

    }

    abstract protected function getSqlFiles(): string|array;


}
