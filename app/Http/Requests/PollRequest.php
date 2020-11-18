<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PollRequest extends FormRequest
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
            'group_id' => 'required',
            'poll_name' => 'required',
            'options' => 'required',
            'options.*' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'group_id.required' => 'Please select group name',
            'options.*.required' => "Please fill all options"
        ];
    }
}
