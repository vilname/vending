<?php

declare(strict_types=1);

namespace App\Entity;

use App\Visit\Repository\VisitRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VisitRepository::class)]
class Visit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: 'datetime', columnDefinition: 'timestamp default current_timestamp')]
    private ?\DateTimeInterface $created = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updated = null;
}