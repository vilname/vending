<?php

declare(strict_types=1);

namespace App\Payment\Controller;

use App\Payment\Command\Pay\PayCommand;
use App\Payment\Command\Pay\PayHandler;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: "/payment")]
class PaymentController extends AbstractController
{
    public function __construct(private PayHandler $payHandler) {}

    #[Route('/create', name: 'payment_create', methods: ["POST"])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new PayCommand($data);
        $this->payHandler->handler($command);

        return $this->json([]);
    }
}