<?php

namespace App\Http\Requests\Backend;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ];

        if ($this->request != null && sizeof($this->all()) > 0) {
            $user = User::find($this->id);

            if ($user) {
                if ($user->email != $this->email) {
                    $rules['email'] = 'required|email|unique:users,email';
                }

                if ($user->username != $this->username) {
                    $rules['username'] = 'required|unique:users,username';
                }
            } else {
                $rules['password'] = 'required|confirmed|min:6';
            }

            // if ($this->password != null) {
            //     $rules['password'] = 'required|confirmed|min:6';
            // }
        }

        return $rules;
    }
}
