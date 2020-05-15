<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationUpdateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'provider_id' => ['required', 'max:255'],
            'start' => ['required'],
            'type' => ['required'],
            'tower_id' => ['required']
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
            'provider_id.required' => 'O campo fornecedor é obrigatório.',
            'type.required' => 'O campo tipo é obrigatório.',
            'tower_id.required' => 'O campo torre é obrigatório.',
        ];
    }
}
