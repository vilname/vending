<?php

declare(strict_types=1);

namespace App\Product\Query\ElementProduct;

use App\Entity\Product;

class ElementProductResult
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