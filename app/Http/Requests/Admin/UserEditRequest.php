<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserEditRequest extends FormRequest
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
        
        $user_id = $this->route('user') ? $this->route('user') : null;

        $password_rule = $user_id ? 'nullable' : 'required';
         



        return [
            'name'=>'required|max:50|min:4|regex:/[a-z0-9 _-]+/iu',
            'password' => 'bail|'.$password_rule.'|min:6|max:15|confirmed',
            'role' => 'required|regex:/[a-z0-9 _-]+/iu|max:50',
            'user_status' => 'required|regex:/[a-z0-9 _-]+/iu|max:50',
            'email' =>  ['required',
                          'email', 
                          !$user_id ? 'unique:users,email' : Rule::unique('users')->ignore($user_id)]
        ];
    }
}
