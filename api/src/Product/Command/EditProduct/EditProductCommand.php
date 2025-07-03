<?php

declare(strict_types=1);

namespace App\Product\Command\EditProduct;

class EditProductCommand
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