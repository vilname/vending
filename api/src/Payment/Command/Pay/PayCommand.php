<?php

declare(strict_types=1);

namespace App\Payment\Command\Pay;

class PayCommand
{
    public int $productId;
    public float $sum;
    public int $qty;

    public function __construct(array $data)
    {
        $this->productId = $data['productId'];
        $this->sum = $data['sum'];
        $this->qty = $data['qty'];
    }
}