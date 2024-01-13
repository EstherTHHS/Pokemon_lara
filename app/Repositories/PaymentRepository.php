<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Cart;

class PaymentRepository implements PaymentRepositoryInterface
{
  public function storePayment($data)
  {

    foreach ($data['data'] as $product) {

      // Cart::create(
      //   [  
      //   'product_id' => $,
      //   'user_id',
      //   'quantity',
      //   'status',]
      // )
    }
  }
}
