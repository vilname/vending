<?php

declare(strict_types=1);

namespace App\Product\Repository;

use App\Common\Dto\PaginationDto;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function findAllWithPagination(PaginationDto $paginationDto): array
    {
        return $this->createQueryBuilder("product")
            ->setFirstResult($paginationDto->getOffset())
            ->setMaxResults($paginationDto->getLimit())
            ->getQuery()
            ->getResult();
    }
}