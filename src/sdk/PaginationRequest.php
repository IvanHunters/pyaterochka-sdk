<?php

declare(strict_types=1);

namespace Lichi\Pyaterochka\Sdk;

use GuzzleHttp\RequestOptions;
use Lichi\Pyaterochka\ApiProvider;

class PaginationRequest
{

    /**
     * @var ApiProvider
     */
    protected ApiProvider $apiProvider;

    public function __construct(ApiProvider $provider)
    {
        $this->apiProvider = $provider;
    }

    public function get($type, $method, $body): array
    {
        $step = 100;
        $offset = 0;
        $body[RequestOptions::QUERY]['limit'] = $step;
        $body[RequestOptions::QUERY]['offset'] = $offset;
        $response = $this->apiProvider->callMethod(
            $type,
            $method,
            $body
        );
        $products = $items = $response['products'];

        if (count($items) < $step)
        {
            return $items;
        }
        while(count($items) !== 0)
        {
            $offset+=$step;
            $body[RequestOptions::QUERY]['limit'] = $step;
            $body[RequestOptions::QUERY]['offset'] = $offset;
            $response = $this->apiProvider->callMethod(
                $type,
                $method,
                $body
            );

            $items = $response['products'];
            $products = array_merge($items, $products);
        }
        return $products;
    }

}