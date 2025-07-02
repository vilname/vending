<?php

declare(strict_types=1);

namespace App\Visit\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): JsonResponse
    {
        return $this->json([
            'name' => 'Иван'
        ]);
    }
}