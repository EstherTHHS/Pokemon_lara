<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Interfaces\PaymentRepositoryInterface;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class PaymentRepository implements PaymentRepositoryInterface
{
  public function storePayment($data)
  {

    $user_id = Auth::user()->id;

    $payments = [];

    foreach ($data['data'] as $product) {

      $cart = Cart::create(
        [
          'product_id' => $product['product_id'],
          'user_id' => $user_id,
          'quantity' => $product['quantity'],

        ]
      );

      $payment = Payment::create([
        'cart_id' =>  $cart->id,
        'user_id' => $user_id,
        'amount' => $data['amount'],
        'payment_method' => $data['payment_method'],
        'payment_date' => $data['payment_date'],
      ]);

      $payments[] = $payment;
    }



    return   $payments;
  }
}
