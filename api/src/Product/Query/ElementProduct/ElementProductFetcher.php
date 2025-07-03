<?php

declare(strict_types=1);

namespace App\Product\Query\ElementProduct;

use App\Entity\Product;
use App\Product\Repository\ProductRepository;

class ElementProductFetcher
{
    public function __construct(private ProductRepository $productRepository) {}

    public function handler(int $id): ElementProductResult
    {
        /** @var Product $product */
        $product = $this->productRepository->find($id);

        return new ElementProductResult($product);
    }
}