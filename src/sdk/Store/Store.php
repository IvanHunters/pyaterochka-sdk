<?php

declare(strict_types=1);

namespace Lichi\Pyaterochka\Sdk\Store;

use GuzzleHttp\RequestOptions;
use Lichi\Pyaterochka\ApiProvider;
use Lichi\Pyaterochka\Sdk\Module;

class Store extends Module
{
    private float $latitude;
    private float $longitude;
    private array $store = [];

    public function __construct(ApiProvider $provider, float $latitude, float $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        parent::__construct($provider);
    }

    public function get(): self
    {
        $this->store = $this->apiProvider->callMethod(
            "GET",
            sprintf("https://5d.5ka.ru/api/orders/v1/orders/stores/?lat=%s&lon=%s", $this->latitude, $this->longitude)
        );
        return $this;
    }

    public function getStoreId(): string
    {
        return @$this->store['sap_code'];
    }

    public function getStoreAddress(): string
    {
        return @$this->store['shop_address'];
    }

    public function hasDelivery(): bool
    {
        return @$this->store['has_delivery'];
    }
}