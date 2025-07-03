<?php

declare(strict_types=1);

namespace App\Product\Controller;

use App\Common\Dto\PaginationDto;
use App\Product\Command\CreateProduct\CreateProductCommand;
use App\Product\Command\CreateProduct\CreateProductHandler;
use App\Product\Command\DeleteProduct\DeleteProductHandler;
use App\Product\Command\EditProduct\EditProductCommand;
use App\Product\Command\EditProduct\EditProductHandler;
use App\Product\Query\ElementProduct\ElementProductFetcher;
use App\Product\Query\ListProduct\ListProductFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route(path: "/product")]
class ProductController extends AbstractController
{

    public function __construct(
        private CreateProductHandler $createProductHandler,
        private EditProductHandler $editProductHandler,
        private ElementProductFetcher $elementProductFetcher,
        private ListProductFetcher $listProductFetcher,
        private DeleteProductHandler $deleteProductHandler,
        private PaginationDto $paginationDto
    ){}

    #[Route('/element/{id}', methods: ["GET"])]
    public function element(int $id): JsonResponse
    {
        $result = $this->elementProductFetcher->handler($id);

        return $this->json([
            'data' => $result
        ]);
    }

    #[Route('/list', methods: ["GET"])]
    public function list(Request $request): JsonResponse
    {
        $paginationDto = $this->paginationDto->pagination($request);

        $result = $this->listProductFetcher->handler($paginationDto);

        return $this->json([
            'data' => $result,
            'pagination' => [
                'limit' => $paginationDto->getLimit(),
                'page' => $paginationDto->getPage(),
            ]
        ]);
    }

    #[Route('/create', methods: ["POST"])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $command = new CreateProductCommand($data);
        $this->createProductHandler->handler($command);

        return $this->json([]);
    }

    #[Route('/edit/{id}', methods: ["PUT"])]
    public function edit(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $command = new EditProductCommand($data);
        $this->editProductHandler->handler($id, $command);

        return $this->json([]);
    }

    #[Route('/delete/{id}', methods: ["DELETE"])]
    public function delete(int $id): JsonResponse
    {
        $this->deleteProductHandler->handler($id);

        return $this->json([]);
    }
}