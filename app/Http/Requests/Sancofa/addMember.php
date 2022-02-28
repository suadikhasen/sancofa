<?php

namespace App\Http\Requests\Sancofa;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Routing\Route;
use Illuminate\Http\Request;
use App\sancofa\SancofaUser;

class addMember extends FormRequest
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
    public function rules(Request $request)
    {
        if ( $request->route()->getName() == 'Sancofa.Members.Update') {

            return [

            'full_name'    =>   'string|required',
            'phone_no'     =>   'digits:10|required',
            'univ_id'      =>   'required|unique:sancofa_user,university_id',
            // 'sancofa_id'   =>   'required|integer:gt:0|exists:sancofa_user,sancofa_id',
            'dept'         =>   'required',
            'gender'       =>   'required|string',
            'photo'        =>   'required|string|in:yes,no',
            'payment'      =>   'required|string|in:yes,no',
        ];

        }
        return [

            'full_name'    =>   'string|required',
            'phone_no'     =>   'digits:10|required',
            'univ_id'      =>   'required|unique:sancofa_user,university_id',
            'sancofa_id'   =>   'required|integer:gt:0|unique:sancofa_user,sancofa_id',
            'dept'         =>   'required',
            'gender'       =>   'required|string',
            'photo'        =>   'required|string|in:yes,no',
            'payment'      =>   'required|string|in:yes,no',
        ];
    }
}
