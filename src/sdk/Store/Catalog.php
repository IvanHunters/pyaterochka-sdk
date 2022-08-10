<?php

declare(strict_types=1);

namespace Lichi\Pyaterochka\Sdk\Store;

use GuzzleHttp\RequestOptions;
use Lichi\Pyaterochka\ApiProvider;
use Lichi\Pyaterochka\Sdk\Module;

class Catalog extends Module
{
    private string $store;
    private array $catalog = [];

    public function __construct(ApiProvider $provider, string $store)
    {
        $this->store = $store;
        parent::__construct($provider);
    }

    public function get(string $category): self
    {
        $this->catalog = $this->paginationRequest->get(
            "GET",
            "/api/cita/v1/products",
            [
                RequestOptions::QUERY => [
                    "category" => $category
                ],
                RequestOptions::HEADERS => [
                    'X-USER-STORE' => $this->store
                ]
            ]
        );

        return $this;
    }

    public function getProducts(): array
    {
        $products = [];
        $catalogs = $this->catalog;
        foreach ($catalogs as $catalog)
        {
            $productId = $catalog['plu'];
            $products[$productId] = $catalog;
        }
        return $products;
    }

}