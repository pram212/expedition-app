<?php

namespace App\Http\Requests\CRM;

use Illuminate\Foundation\Http\FormRequest;

class RegisterKiaRequest extends FormRequest
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
            'id_card'           => 'required|max:20',
            'customer_name'     => 'required|max:45',
            'customer_guardian' => 'required|max:45',
            'phone'             => 'required|max:25',
            'category_id'       => 'required',
            'district_id'       => 'required',
            'village_id'        => 'required',
            'address'           => 'required',
        ];
    }
}
