<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Services\PaymentService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;

class PaymentController extends Controller
{

    protected $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    public function store(PaymentRequest $request)
    {

        try {

            $startTime = microtime(true);



            $data = $this->paymentService->storePayment($request->validated());

            return response()->success($request, $data, 'Payment  Create Successfully.', 201, $startTime, 1);
        } catch (Exception $e) {
            Log::channel('sora_error_log')->error("Product Create Error" . $e->getMessage());
            return response()->error($request, null, $e->getMessage(), 500, $startTime);
        }
    }
}
