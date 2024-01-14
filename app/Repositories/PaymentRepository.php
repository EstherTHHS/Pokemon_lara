<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\UserProduct;
use Illuminate\Support\Facades\Auth;

class PaymentRepository implements PaymentRepositoryInterface
{
  public function storePayment($data)
  {

    $user_id = Auth::user()->id;

    foreach ($data['data'] as $product) {

      $user_product = UserProduct::create([
        'user_id' =>  $user_id,
        'product_id' => $product['product_id']
      ]);

      Cart::create(
        [
          'user_product_id' => $user_product->id,
          'quantity' => $product['quantity'],

        ]
      );
    }

    $payment = Payment::create([
      'user_id' => $user_id,
      'amount' => $data['amount'],
      'payment_method' => $data['payment_method'],
      'payment_date' => $data['payment_date']
    ]);

    return   $payment;
  }
}
