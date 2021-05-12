<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
                'name'=>'required|string|min:5',

        ];
    }

     public function messages()
    {
        return [
            'name.required' => 'İsim kısmı zorunludur.',
            'name.string' => 'İsim kısmı metin tipinde olmalıdır.',
            'name.min' => 'İsim kısmı en az 5 karakterden oluşmalıdır.',
            
        ];
    }
}