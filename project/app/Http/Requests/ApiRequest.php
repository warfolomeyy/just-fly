<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

abstract class ApiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = [
            'message' => 'Validation error',
        ];

        foreach ($validator->errors()->toArray() as $field => $messages) {
            $response[$field] = $messages[0];
        }

        throw new HttpResponseException(response()->json($response, 422));
    }
}
