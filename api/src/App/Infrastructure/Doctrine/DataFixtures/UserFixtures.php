<?php

namespace App\Infrastructure\Doctrine\DataFixtures;

use App\Domain\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private UserPasswordEncoderInterface $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin->setEmail('admin@example.com');
        $admin->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'));
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);

        $editor = new User();
        $editor->setEmail('editor@example.com');
        $editor->setPassword($this->passwordEncoder->encodePassword($editor, 'editor'));
        $editor->setRoles([
            'ROLE_EDITOR',
        ]);

        $manager->persist($editor);

        for ($i = 1; $i <= 10; $i++) {
            $player = new User();
            $player->setEmail(sprintf('player_%02s@example.com', $i));
            $player->setPassword($this->passwordEncoder->encodePassword($player, 'player'));
            $player->setRoles([
                'ROLE_PLAYER',
            ]);

            $manager->persist($player);

        }

        $manager->flush();
    }
}
