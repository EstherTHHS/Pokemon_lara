<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
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


    $relatedProducts->each(function ($relatedProduct) {
      $relatedProduct->image_url = asset('image/' . $relatedProduct->image_url);
    });


    return [
      'product' => $product,
      'relatedProducts' => $relatedProducts,
    ];
  }


  public function storeProduct($validatedData)
  {
    $image = $validatedData['image_url'];
    $image_url = time() . "_" .  $image->getClientOriginalName();
    $image->storeAs('image/' .  $image_url);
    $data = Product::create([
      'name' => $validatedData['name'],
      'description' => $validatedData['description'],
      'price' => $validatedData['price'],
      'type' => $validatedData['type'],
      'rarity' => $validatedData['rarity'],
      'left' => $validatedData['left'],
      'image_url' => $image_url,

    ]);

    return $data;
  }



  public function updateProduct($request, $id)
  {
    $product = Product::where('id', $id)->first();
    $product->name = $request['name'];
    $product->description = $request['description'];
    $product->price  = $request['price'];
    $product->type  = $request['type'];
    $product->rarity  = $request['rarity'];
    $product->left = $request['left'];
    $data = $product->save();
    return $data;
  }


  public function deleteProduct($id)
  {
    $product = Product::where('id', $id)->first();

    if (!$product) {
      return null;
    }

    $product->delete();

    return $product;
  }

  public function deleteProductImage($id)
  {


    $product = Product::where('id', $id)->first();

    if (!$product) {
      return null;
    }

    if ($product->image_url) {
      Storage::delete('image/' . $product->image_url);
      $product->image_url = null;
      $data = $product->save();
    }
    return $data;
  }


  public function productStatus($id)
  {

    $product = Product::where('id', $id)->first();
    if (!$product) {
      return null;
    }
    $product->status = $product->status == 1 ? 0 : 1;
    $product->save();

    return $product;
  }
}
