<?php

namespace App\Infrastructure\UI\Symfony\Controller;

use App\Domain\User\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Security\Core\Security;

class ProfileController extends AbstractController
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function __invoke()
    {
        $user = $this->security->getUser();
        if (!($user instanceof User)) {
            return new JsonResponse([
                'user' => []
            ]);
        }

        $roles = array_map(function (string $role) {
            return preg_replace('/^(ROLE_)/', '', $role);
        }, $user->getRoles());

        return new JsonResponse([
            'user' => [
                'name' => $user->getUsername(),
                'email' => $user->getEmail(),
                'roles' => $roles,
            ]
        ]);
    }
}
