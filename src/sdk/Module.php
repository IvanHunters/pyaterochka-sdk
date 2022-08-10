<?php

declare(strict_types=1);

namespace Lichi\Pyaterochka\Sdk;

use Lichi\Pyaterochka\ApiProvider;

class Module
{

    /**
     * @var ApiProvider
     */
    protected ApiProvider $apiProvider;
    /**
     * @var PaginationRequest
     */
    protected PaginationRequest $paginationRequest;

    public function __construct(ApiProvider $provider)
    {
        $this->apiProvider = $provider;
        $this->paginationRequest = new PaginationRequest($provider);
    }

}