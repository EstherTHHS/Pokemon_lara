<?php

namespace App\Services;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;
use PhpParser\Node\NullableType;

class ProductService
{
  protected $ProductRepoInterface;

  public function __construct(ProductRepositoryInterface $ProductRepoInterface)
  {
    $this->ProductRepoInterface = $ProductRepoInterface;
  }

  public function getProduct(Request $request)
  {
    return $this->ProductRepoInterface->getProduct($request);
  }


  public function getProudctById($id)
  {
    return $this->ProductRepoInterface->getProudctById($id);
  }




  public function storeProduct($validatedData)
  {

    return $this->ProductRepoInterface->storeProduct($validatedData);
    // $image = $validatedData['image_url'];
    // $image_url = time() . "_" .  $image->getClientOriginalName();
    // $image->storeAs('image/' .  $image_url);
    // $data = Product::create([
    //   'name' => $validatedData['name'],
    //   'description' => $validatedData['description'],
    //   'price' => $validatedData['price'],
    //   'type' => $validatedData['type'],
    //   'rarity' => $validatedData['rarity'],
    //   'left' => $validatedData['left'],
    //   'image_url' => $image_url,

    // ]);

    // return $data;
  }


  public function updateProduct($request, $id)
  {
    return $this->ProductRepoInterface->updateProduct($request, $id);
  }


  public function deleteProduct($id)
  {
    return $this->ProductRepoInterface->deleteProduct($id);
  }

  public function deleteProductImage($id)
  {
    return $this->ProductRepoInterface->deleteProductImage($id);
  }

  public function productStatus($id)
  {
    return $this->ProductRepoInterface->productStatus($id);
  }
}
