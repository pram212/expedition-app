<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'register_number'=> 'required',
            'category_id'=> 'required',
            'payment_statuses_id'=> 'required',
            'shippment_statuses_id'=> 'required',
            'id_card'=> 'required',
            'customer_name'=> 'required',
            'phone'=> 'required',
            'district_id'=> 'required',
            'village_id'=> 'required',
            'address'=> 'required'
        ];
    }
}
