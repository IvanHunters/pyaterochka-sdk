<?php

declare(strict_types=1);

namespace Lichi\Pyaterochka\Sdk\Store;

use GuzzleHttp\RequestOptions;
use Lichi\Pyaterochka\ApiProvider;
use Lichi\Pyaterochka\Sdk\Module;

class Category extends Module
{
    private string $store;

    public function __construct(ApiProvider $provider, string $store)
    {
        $this->store = $store;
        parent::__construct($provider);
    }


    public function get(): array
    {
        return $this->apiProvider->callMethod(
            "GET",
            "/api/cita/v5/categories/",
            [
                RequestOptions::HEADERS => [
                    'X-USER-STORE' => $this->store
                ]
            ]
        );
    }


}