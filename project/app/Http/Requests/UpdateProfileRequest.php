<?php
namespace App\Http\Requests;

class UpdateProfileRequest extends ApiRequest
{
    public function rules(): array
    {
        $userId = $this->user()?->id;

        return [
            'fio' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => ['sometimes', 'required', 'email', 'unique:users,email,' . $userId],
            'password' => ['sometimes', 'required', 'string', 'min:6'],
            'avatar' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
