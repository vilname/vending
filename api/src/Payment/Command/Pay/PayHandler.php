<?php

declare(strict_types=1);

namespace App\Payment\Command\Pay;

use App\Entity\Payment;
use App\Entity\Product;
use App\Payment\Webclient\RobokassaClient;
use App\Product\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class PayHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private RobokassaClient $robokassaClient,
        private ProductRepository $productRepository,
    ) {}

    public function handler(PayCommand $command)
    {
        if (!$this->robokassaClient->pay()) {
            throw new \Exception('ошибка оплаты');
        }


        /** @var Product $product */
        $product = $this->productRepository->find($command->productId);

//        echo "<pre>";
//        print_r($product->getQty());
//        echo "</pre>";
//        die();

        if ($product->getQty() < $command->qty) {
            throw new \Exception('недостаточное количество');
        }

        $product->setQty($product->getQty() - $command->qty);

        $payment = new Payment();
        $payment->setProduct($product);
        $payment->setQty($command->qty);
        $payment->setSum($command->sum);

        $this->entityManager->persist($payment);
        $this->entityManager->flush();
    }
}