<?php

declare(strict_types=1);

namespace App\Product\Command\DeleteProduct;

use App\Entity\Product;
use App\Product\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;

class DeleteProductHandler
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private ProductRepository $productRepository
    ) {}

    public function handler(int $id): void
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);
        if (empty($product)) {
            return;
        }

        $this->entityManager->remove($product);
        $this->entityManager->flush();
    }
}