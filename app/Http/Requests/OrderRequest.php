<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'name' => 'required|max:100',
            'address' => 'required|max:200',
            'phone' => 'required|regex:/(0)[0-9]{9,10}/|max:11',
            // 'note' => 'required|max:200',
            // 'total' => 'required|min:1|max:100'
        ];
    }
}
