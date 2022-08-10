<?php

include "vendor/autoload.php";
use GuzzleHttp\Client;
use Lichi\Pyaterochka\ApiProvider;

$client = new Client([
    'base_uri' => "https://5d.5ka.ru",
    'verify' => false,
    'timeout'  => 30.0,
]);

$apiProvider = new ApiProvider($client);
//$storeId = $apiProvider->store(61.668797, 50.836497)->get()->getStoreId();
$storeId = "O194";
$categories = $apiProvider->category($storeId)->get();

$catalog = [];
foreach ($categories as $index => $category)
{
    $categoryId = $category['id'];
    $categoryName = $category['name'];

    $items = $apiProvider->catalog($storeId)->get($categoryId)->getProducts();

    foreach ($items as $key => $item)
    {
        $items[$key]['category'] = $categoryName;
    }

    $catalog += $items;
}
file_put_contents("$storeId.json", json_encode($catalog, JSON_UNESCAPED_UNICODE));

$a = 10;

//foreach ($stores as $store)
//{
//    $storeId = $store['id'];
//    $title = $store['slug'];
//
//    $categories = $apiProvider->category($storeId)->get();
//    $categoryIds = array_column($categories, "id");
//    $catalog = [];
//    foreach ($categoryIds as $categoryId)
//    {
//        $products = $apiProvider->catalog($storeId)->get([$categoryId])->getProducts();
//        $catalog = $products + $catalog;
//    }
//
//    file_put_contents("skt/$title.json", json_encode($catalog, JSON_UNESCAPED_UNICODE));
//}
