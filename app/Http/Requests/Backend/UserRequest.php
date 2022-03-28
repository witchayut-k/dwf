<?php

namespace App\Http\Requests\Backend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $rules = [
            'username' => 'required|min:4|unique:users,username,NULL,id,deleted_at,NULL',
            'name' => 'required',
            'email' => 'required|min:1|unique:users,email,NULL,id,deleted_at,NULL',
            'role' => 'required',
        ];

        if ($this->request != null && sizeof($this->all()) > 0) {
            $user = User::find($this->id);

            if ($user) {
                $rules['username'] = ['required', Rule::unique('users')->ignore($this->id)];
                $rules['email'] = ['required', 'email', Rule::unique('users')->ignore($this->id)];
            } else {
                $rules['password'] = 'required|confirmed|min:6';
            }

            if ($this->password != null) {
                $rules['password'] = 'required|confirmed|min:6';
            }
        }

        return $rules;
    }
}
