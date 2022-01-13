<?php

namespace App\Http\Requests\Backend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required'
        ];
        
        // $rules = [
        //     'name' => 'required|max:100',
        //     'email' => 'required|email|unique:users,email,NULL,id,deleted_at,NULL',
        //     'password' => ''
        // ];

        // $user = User::find($this->id);
        // if ($user) {
        //     if ($user->email == $this->email) {
        //         $rules['email'] = 'required|email';
        //     }
        // }

        // if ($this->password) {
        //     $rules['password'] = 'required|confirmed|min:6|max:12';
        //     // $rules['password_confirmation'] = 'required|min:6|max:12';
        // }

        // return $rules;
    }
}
