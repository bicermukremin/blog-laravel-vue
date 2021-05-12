<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
                'email'=>'required|string|email',
                'password'=>'required|string|min:5|max:15',
                

        ];
    }
     public function messages()
    {
        return [
            'email.required' => 'Email kısmı zorunludur.',
            'email.string' => 'Email kısmı metin tipinde olmalıdır.',
            'email.email' => 'Email geçerli bir email adresi olmalıdır.',
            
            'password.required' => 'Şifre kısmı zorunludur.',
            'password.string' => 'Şifre kısmı metin tipinde olmalıdır.',
            'password.min' => 'Şifre kısmı en az 5 karakterden oluşmalıdır.',
            'password.max' => 'Şifre kısmı en fazla 15 karakterden oluşmalıdır.',
            
          
        ];
    }
}