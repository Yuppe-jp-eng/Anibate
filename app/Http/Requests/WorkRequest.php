<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkRequest extends FormRequest
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
            'user_id' => ['integer'],
            'broadcast_season' => ['string', 'size:6'],
            'title' => ['string'],
            'memo' => ['max:100'],
            'year' => ['size:4'],
            'season' => ['string', 'size:1'],
        ];
    }
}
