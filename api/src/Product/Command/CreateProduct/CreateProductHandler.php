<?php

declare(strict_types=1);

namespace App\Product\Command\CreateProduct;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;

class CreateProductHandler
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    public function handler(CreateProductCommand $command): void
    {
        $product = new Product();
        $product->setName($command->name);
        $product->setPrice($command->price);
        $product->setQty($command->qty);

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}