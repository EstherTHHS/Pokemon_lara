<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
  protected function limit(Request $request)
  {
    $limit = (int)$request->input('limit', Config::get('paginate.default_limit'));

    return $limit;
  }
  public function getProduct(Request $request)
  {

    $type = $request->input('type');
    $rarity = $request->input('rarity');
    $search = $request->input('search');

    $products = Product::where('status', '1')->orderBy('created_at', 'desc');

    $products = $products->FilterProduct($search, $type, $rarity);

    $result = $products->get();

    return $result;
  }


  public function getProudctById($id)
  {

    $product = Product::where('id', $id)->where('status', '1')->first();


    if ($product == null) {
      return null;
    }


    if (!$product) {

      return null;
    }


    $product->image_url = asset('image/' . $product->image_url);


    $type = $product->type;


    $relatedProducts = Product::where('type', $type)
      ->where('status', '1')
      ->inRandomOrder()
      ->take(3)
      ->get();


    $relatedProducts->each(function ($relatedItem) {
      $relatedItem->image_url = asset('image/' . $relatedItem->image_url);
    });


    return [
      'product' => $product,
      'relatedItems' => $relatedProducts,
    ];
  }
}
