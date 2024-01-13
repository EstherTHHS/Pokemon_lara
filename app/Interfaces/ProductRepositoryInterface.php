<?php

namespace App\Interfaces;

use Illuminate\Http\Request;



interface ProductRepositoryInterface
{
  public function getProduct(Request $request);

  public function getProudctById($id);

  public function storeProduct($validatedData);

  public function updateProduct(Request $request, $id);

  public function deleteProduct($id);

  public function deleteProductImage($id);

  public function productStatus($id);
}
