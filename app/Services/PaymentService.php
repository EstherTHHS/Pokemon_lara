<?php

namespace App\Services;

use App\Interfaces\PaymentRepositoryInterface;

class PaymentService
{
  protected $paymentRepoInterface;

  public function __construct(PaymentRepositoryInterface $paymentRepoInterface)
  {
    $this->paymentRepoInterface = $paymentRepoInterface;
  }

  public function storePayment($request)
  {
    return $this->paymentRepoInterface->storePayment($request);
  }
}
