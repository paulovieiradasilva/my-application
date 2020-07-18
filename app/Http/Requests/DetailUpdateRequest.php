<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DetailUpdateRequest extends FormRequest
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
            'application_id' => ['required'],
            'environment_id' => ['required'],
            'type' => ['required'],
            'content' => ['required']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'application_id.required' => 'O campo aplicação é obrigatório.',
            'environment_id.required' => 'O campo ambiente é obrigatório.',
            'type.required' => 'O campo tipo é obrigatório.',
        ];
    }
}
