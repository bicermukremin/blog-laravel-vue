<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
                'name'=>'required|string|min:3',
                'email'=>'required|string|email|unique:users',
                'password'=>'required|string|min:5|max:15|confirmed',
                

        ];
    }
     public function messages()
    {
        return [
            'name.required' => 'İsim kısmı zorunludur.',
            'name.string' => 'İsim kısmı metin tipinde olmalıdır.',
            'name.min' => 'İsim kısmı en az 3 karakterden oluşmalıdır',
            
            
            'email.required' => 'Email kısmı zorunludur.',
            'email.string' => 'Email kısmı metin tipinde olmalıdır.',
            'email.email' => 'Email geçerli bir email adresi olmalıdır.',
            'email.unique' => 'Bu email adresi ile zaten bir hesabınız bulunmaktadır.',
            
            'password.required' => 'Şifre kısmı zorunludur.',
            'password.string' => 'Şifre kısmı metin tipinde olmalıdır.',
            'password.min' => 'Şifre kısmı en az 5 karakterden oluşmalıdır.',
            'password.max' => 'Şifre kısmı en fazla 15 karakterden oluşmalıdır.',
            'password.confirmed' => 'Şifreleriniz birbiri ile eşleşmelidir.',
            
          
        ];
    }
}