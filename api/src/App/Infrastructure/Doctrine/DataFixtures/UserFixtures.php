<?php

namespace App\Infrastructure\Doctrine\DataFixtures;


use App\Domain\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('admin@example.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'admin'));
        $user->setRoles(['ROLE_ADMIN']);

        $manager->persist($user);

        $user = new User();
        $user->setEmail('editor@example.com');
        $user->setPassword($this->passwordEncoder->encodePassword($user, 'editor'));
        $user->setRoles([
            'ROLE_EDITOR'
        ]);

        $manager->persist($user);

        $manager->flush();

    }
}
