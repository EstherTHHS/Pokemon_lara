<?php

namespace App\Interfaces;

use Illuminate\Http\Request;



interface ProductRepositoryInterface
{
  public function getProduct(Request $request);

  public function getProudctById($id);
}
