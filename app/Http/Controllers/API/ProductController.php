<?php

namespace App\Http\Controllers\API;

use Exception;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{

    protected  $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {

            $startTime = microtime(true);

            $data = $this->productService->getProduct($request);
            $result = ProductResource::collection($data);

            return response()->success($request, $result, 'Product Data found Successfully.', 200, $startTime, count($result));
        } catch (Exception $e) {
            Log::channel('sora_error_log')->error("Product Store Error" . $e->getMessage());
            return response()->error(request(), null, $e->getMessage(), 500, $startTime);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {


        try {

            $startTime = microtime(true);

            $validatedData = $request->validated();

            $data = $this->productService->storeProduct($validatedData);

            return response()->success($request, $data, 'Product Create Successfully.', 201, $startTime, 1);
        } catch (Exception $e) {
            Log::channel('sora_error_log')->error("Product Store Error" . $e->getMessage());
            return response()->error($request, null, $e->getMessage(), 500, $startTime);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id, Request $request)
    {
        try {

            $startTime = microtime(true);

            $data = $this->productService->getProudctById($id);

            if ($data == null) {
                return response()->error(request(), [], "Data not found ", 404, $startTime);
            }

            return response()->success($request, $data, 'Product Data found Successfully.', 200, $startTime, count($data));
        } catch (Exception $e) {
            Log::channel('sora_error_log')->error("Product Store Error" . $e->getMessage());
            return response()->error(request(), null, $e->getMessage(), 500, $startTime);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
