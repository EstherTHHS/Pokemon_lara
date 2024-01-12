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

    $products = Product::where('status', '1')->get();
    $products->each(function ($product) {
      $product->image_url = asset('image/' . $product->image_url);
    });
    return $products;


    // $products->when($type ?? false, function ($query, $type) {
    //   $query->where('type', 'like', "%$type%");
    // });

    // $products->when($rarity ?? false, function ($query, $rarity) {
    //   $query->where('rarity', 'like', "%$rarity%");
    // });
    // $data = $products->orderBy('created_at', 'desc')->paginate($this->limit($request));

    // return $products;
  }
}
