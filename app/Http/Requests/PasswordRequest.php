<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PasswordRequest extends FormRequest
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
            'password' => 'required|confirmed|min:8',
           
        ];
    }
     public function messages()
    {
        return [
            'password.required' => 'Şifre kısmı zorunludur.',
            'password.confirmed' => 'Şifreleriniz uyuşmuyor',
            'password.min' => 'Şifre kısmı en az 8 karakterden oluşmalıdır.',
            
            
            /* 'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ', */
        ];
    }
}
