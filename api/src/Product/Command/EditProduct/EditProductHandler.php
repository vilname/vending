<?php

declare(strict_types=1);

namespace App\Product\Command\EditProduct;

use App\Entity\Product;
use App\Product\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class EditProductHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProductRepository $productRepository
    ) {}

    public function handler(int $id, EditProductCommand $command): void
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);
        $product->setName($command->name);
        $product->setPrice($command->price);
        $product->setQty($command->qty);

        $this->entityManager->persist($product);
        $this->entityManager->flush();
    }
}