<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'konu'=>'required|string|min:5',
            'content'=>'required|string|min:15|max:400',
            'ad_soyad'=>'required|string|min:5|max:70',
            'email'=>'required|email|string',
            
        ];
    }
     public function messages()
    {
        return [
            'konu.required' => 'Konu kısmı zorunludur.',
            'konu.string' => 'Konu kısmı metin tipinde olmalıdır.',
            'konu.min' => 'Konu kısmı en az 5 karakterden oluşmalıdır.',

            'email.required' => 'Mail kısmı zorunludur.',
            'email.string' => 'Mail kısmı metin tipinde olmalıdır.',
            'email.email' => 'Mail adresiniz geçerli bir mail adresi olmalıdır.',

            'ad_soyad.required' => 'İsim kısmı zorunludur.',
            'ad_soyad.string' => 'İsim kısmı metin tipinde olmalıdır.',
            'ad_soyad.min' => 'İsim kısmı en az 5 karakterden oluşmalıdır.',

            'content.required' => 'İçerik kısmı zorunludur.',
            'content.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'content.min' => 'İçerik kısmı en az 15 karakterden oluşmalıdır.',
            'content.max' => 'İçerik kısmı en fazla 400 karakterden oluşmalıdır.',
            
            
        ];
    }
}