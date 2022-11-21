<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainEditOrderDetailQtyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'qty' => 'Adet',
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
            'qty' => 'required|numeric|max:1000',
        ];
    }
}
