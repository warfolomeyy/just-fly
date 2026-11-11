<?php
namespace App\Http\Requests;

class UpdateProfileRequest extends ApiRequest {
    public function rules(): array {
        return [
            'fio' => 'sometimes', 'required', 'max:255', 'string',
            'email' => ['sometimes', 'email', 'unique:users,email,' . $this->user()->id],
        ];
    }
}
