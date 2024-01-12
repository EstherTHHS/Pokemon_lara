<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'type' => 'required|in:grass,fire,water,lightning,psychic,fighting,darkness,metal,fairy',
            'rarity' => 'required|in:circle,diamond,star',
            'left' => 'required',
            'image_url' => 'required|mimes:jpeg,png,jpg,pdf|dimensions:min_width=50,min_height=50|max:10240',
            'status' => ''
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'success' => 0,
                'code' => Response::HTTP_UNPROCESSABLE_ENTITY,
                'meta' => [
                    'method' => $this->getMethod(),
                    'endpoint' => $this->path(),
                    'limit' => $this->input('limit', 0),
                    'offset' => $this->input('offset', 0),
                    'total' => 0,
                ],
                'data' => [
                    'message' => 'The given data was invalid.',
                    'errors' => $validator->errors(),
                ],
                'duration' => (float)sprintf("%.3f", (microtime(true) - LARAVEL_START)),
            ], Response::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
