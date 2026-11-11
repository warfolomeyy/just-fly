<?php

namespace App\Http\Requests;


class RegisterRequest extends ApiRequest {
    public function rules(): array {
        return [
            'fio' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'avtar' => ['nullable', 'string'],
        ];
    }
}
