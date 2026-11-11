<?php
namespace App\Http\Requests;

class UpdateProductRequest extends ApiRequest {
    public function rules() {
        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],
            'price' => ['sometimes', 'required', 'numeric', 'min:0'],
        ];
    }
}
