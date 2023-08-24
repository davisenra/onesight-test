<?php

declare(strict_types=1);

namespace App\Auth\Controller;

use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController
{
    #[Route('/logout', name: 'logout', methods: 'POST')]
    public function logout(Security $security): never
    {
        // Route will be intercepted by Symfony
        throw new \Exception('');
    }
}