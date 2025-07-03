<?php

declare(strict_types=1);

namespace App\Product\Command\CreateProduct;

class CreateProductCommand
{
    public string $name;
    public float $price;
    public int $qty;

    public function __construct(array $data)
    {
        $this->name = $data['name'];
        $this->price = $data['price'];
        $this->qty = $data['qty'];
    }
}