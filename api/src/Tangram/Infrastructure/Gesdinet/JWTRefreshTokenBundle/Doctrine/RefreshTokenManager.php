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

namespace Tangram\Infrastructure\Gesdinet\JWTRefreshTokenBundle\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Gesdinet\JWTRefreshTokenBundle\Entity\RefreshTokenRepository;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenInterface;
use Gesdinet\JWTRefreshTokenBundle\Model\RefreshTokenManager as BaseRefreshTokenManager;

final class RefreshTokenManager extends BaseRefreshTokenManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $objectManager;

    /**
     * @var string
     */
    protected $class;

    /**
     * @var RefreshTokenRepository
     */
    protected $repository;

    /**
     * Constructor.
     *
     * @param ObjectManager $om
     * @param string        $class
     */
    public function __construct(ObjectManager $om, $class)
    {
        $this->objectManager = $om;
        $this->repository = $om->getRepository($class);
        $metadata = $om->getClassMetadata($class);
        $this->class = $metadata->getName();
    }

    /**
     * @param string $refreshToken
     *
     * @return RefreshTokenInterface
     */
    public function get($refreshToken)
    {
        return $this->repository->findOneBy(array('refreshToken' => $refreshToken));
    }

    /**
     * @param string $username
     *
     * @return RefreshTokenInterface
     */
    public function getLastFromUsername($username)
    {
        return $this->repository->findOneBy(array('username' => $username), array('valid' => 'DESC'));
    }

    /**
     * @param RefreshTokenInterface $refreshToken
     * @param bool|true             $andFlush
     */
    public function save(RefreshTokenInterface $refreshToken, $andFlush = true)
    {
        $this->objectManager->persist($refreshToken);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * @param RefreshTokenInterface $refreshToken
     * @param bool                  $andFlush
     */
    public function delete(RefreshTokenInterface $refreshToken, $andFlush = true)
    {
        $this->objectManager->remove($refreshToken);

        if ($andFlush) {
            $this->objectManager->flush();
        }
    }

    /**
     * @param \DateTime $datetime
     * @param bool      $andFlush
     *
     * @return RefreshTokenInterface[]
     */
    public function revokeAllInvalid($datetime = null, $andFlush = true)
    {
        $invalidTokens = $this->repository->findInvalid($datetime);

        foreach ($invalidTokens as $invalidToken) {
            $this->objectManager->remove($invalidToken);
        }

        if ($andFlush) {
            $this->objectManager->flush();
        }

        return $invalidTokens;
    }

    /**
     * Returns the RefreshToken fully qualified class name.
     *
     * @return string
     */
    public function getClass()
    {
        return $this->class;
    }
}
