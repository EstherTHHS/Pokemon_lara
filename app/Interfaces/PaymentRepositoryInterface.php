<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PaymentRepositoryInterface
{
  public function storePayment(Request $request);
}
