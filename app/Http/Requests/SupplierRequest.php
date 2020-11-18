<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'supplier_name' => 'required',
            'supplier_image' => 'required|mimes:png,jpeg,jpg|max:2048',
            'supplier_address' => 'required',
            'supplier_rating' => 'required',
            'spare_part_name.*' => 'required',
            'spare_part_number.*' => 'required',
            'spare_part_image' => 'required|max:255',
            'spare_part_image.*' => 'required|mimes:png,jpeg,jpg|max:2048',
        ];
    }
}
