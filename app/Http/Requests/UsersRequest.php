<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'role_id'    => 'required|not_in:0',
            'login'     => 'required|unique:users,deleted_at,NULL|max:255',
            'password'  => 'required',
            're-password' => 'required|same:password'
        ];
    }
}
