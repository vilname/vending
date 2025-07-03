<?php

declare(strict_types=1);

namespace App\Entity;

use App\Product\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column]
    private float $price;

    #[ORM\Column]
    private int $qty;

    #[ORM\OneToMany(targetEntity: Payment::class, mappedBy: 'product')]
    private ?Collection $payments;

    #[ORM\Column(type: 'datetime', columnDefinition: 'timestamp default current_timestamp')]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $updated = null;

    public function __construct()
    {
        $this->payments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }


    public function getQty(): int
    {
        return $this->qty;
    }

    public function setQty(int $qty): void
    {
        $this->qty = $qty;
    }

    public function addPayment(Payment $payment): static
    {
        if ($this->payments->contains($payment)) {
            $this->payments->add($payment);
            $payment->setProduct($this);
        }

        return $this;
    }

    public function removePayment(Payment $payment): static
    {
        $this->payments->removeElement($payment);

        return $this;
    }

    #[ORM\PrePersist]
    public function setCreated(): void
    {
        $this->created = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function setUpdated(): void
    {
        $this->updated = new \DateTimeImmutable();
    }

    public function __toString(): string
    {
        return $this->getName() . $this->getId();
    }
}