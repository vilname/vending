<?php

declare(strict_types=1);

namespace App\Product\Query\ListProduct;

use App\Common\Dto\PaginationDto;
use App\Entity\Product;
use App\Product\Repository\ProductRepository;

class ListProductFetcher
{
    public function __construct(private ProductRepository $productRepository) {}

    /**
     * @return ListProductResult[]
     */
    public function handler(PaginationDto $paginationDto): array
    {
        $products = $this->productRepository->findAllWithPagination($paginationDto);

        return array_map(function (Product $product) {
            return new ListProductResult($product);
        }, $products);
    }
}