<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCompleteOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function attributes()
    {
        return [
            'order_id' => 'Sipariş',  
            'payment_type'  => 'Ödeme Tipi'
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
            'order_id'      => 'required',
            'payment_type'  => 'required'
        ];
    }
}
