<?php

namespace App\Http\Requests\Sancofa;

use Illuminate\Foundation\Http\FormRequest;

class EditBook extends FormRequest
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
            'name'       => 'required',
            'author'     => 'required',
            'donate'     => 'required',
            'price'      => 'required|gt:0',
            'catagory'   => 'required',
        ];
    }
}
