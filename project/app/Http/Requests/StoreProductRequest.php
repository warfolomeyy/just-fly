<?php

namespace App\Http\Requests;

class StoreProductRequest extends ApiRequest {
    public function rules() {
        return[
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
        ];
    }
}
