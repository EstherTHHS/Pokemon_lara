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
