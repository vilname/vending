<?php

declare(strict_types=1);

namespace App\Module\Visit\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return new Response('Hello!');
    }
}