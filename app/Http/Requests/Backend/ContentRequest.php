<?php

namespace App\Http\Requests\Backend;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class ContentRequest extends FormRequest
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
            'title' => 'required',
            'center_name' => 'required_if:content_type_id,' . Config::get('dwf.regional_content_id'),
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'center_name.required_if' => 'ข้อมูลในช่องนี้จำเป็นต้องระบุ',
        ];
    }
}
