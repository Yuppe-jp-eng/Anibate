<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->name !== null) {
            return [
                'name' => ['string', 'min:3', 'max:16', 'unique:users'],
                'profile_image' => ['mimes:jpeg,png'],
                'description' => ['max:160'],
            ];
        }
        return[
            'profile_image' => ['mimes:jpeg,png'],
            'description' => ['max:160'],
        ];
        }


    public function attributes()
    {
        return[
            'name' => 'ユーザー名',
            'profile_image' => 'ユーザー画像',
            'description' => '自己紹介文',
        ];

    }
}
