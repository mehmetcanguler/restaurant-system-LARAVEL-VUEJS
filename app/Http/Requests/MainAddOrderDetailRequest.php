<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainAddOrderDetailRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'product_id' => 'Ürün',
            'title' => 'Detay',
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
            'product_id'    => 'required',
            'title'         => 'max:255',
            'qty'           => 'required|numeric',
        ];
    }
}
