<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'name' => 'isim soyisim',
            'email' => 'E-posta',
            'password' => 'Parola',
            'password_confirmation' => 'Parola Tekrar',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'min:3',
            'email' => 'email',
            'password' => 'confirmed',
        ];
    }
}