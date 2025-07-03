<?php

declare(strict_types=1);

namespace App\Product\Query\ListProduct;

use App\Entity\Product;

class ListProductResult
{
    public string $name;
    public float $price;
    public int $qty;

    public function __construct(Product $product)
    {
        $this->name = $product->getName();
        $this->price = $product->getPrice();
        $this->qty = $product->getQty();
    }
}