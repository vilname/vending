<?php

declare(strict_types=1);

namespace App\Entity;

use App\Payment\Repository\PaymentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaymentRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Payment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Product::class, inversedBy: 'payments')]
    #[ORM\Column]
    private Product $product;

    #[ORM\Column]
    private int $qty;

    #[ORM\Column]
    private float $sum;

    #[ORM\Column(type: 'datetime', columnDefinition: 'timestamp default current_timestamp')]
    private ?\DateTimeInterface $created = null;

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function getSum(): float
    {
        return $this->sum;
    }

    public function setSum(float $sum): void
    {
        $this->sum = $sum;
    }

    #[ORM\PrePersist]
    public function setCreated(): void
    {
        $this->created = new \DateTimeImmutable();
    }
}