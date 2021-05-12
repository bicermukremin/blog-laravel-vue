<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
                
                'adres'=>'required|string|min:10|max:100',
                'map'=>'required|string|min:10',
                'facebook'=>'required|string|min:10',
                'twitter'=>'required|string|min:10',
                'linkedIn'=>'required|string|min:10',
                'instagram'=>'required|string|min:10',
                'github'=>'required|string|min:10',
                'tel'=>'required|string|min:10',
                'email'=>'required|email|string',
                

        ];
    }
    public function messages()
    {
        return [
            'map.required' => 'Google Maps kısmı zorunludur.',
            'map.string' => 'Google Maps kısmı metin tipinde olmalıdır.',
            'map.min' => 'Google Maps kısmı en az 5 karakterden oluşmalıdır.',

            'facebook.required' => 'Facebook kısmı zorunludur.',
            'facebook.string' => 'Facebook kısmı metin tipinde olmalıdır.',
            'facebook.min' => 'Facebook kısmı en az 10 karakterden oluşmalıdır.',

            'twitter.required' => 'Twitter kısmı zorunludur.',
            'twitter.string' => 'Twitter kısmı metin tipinde olmalıdır.',
            'twitter.min' => 'Twitter kısmı en az 10 karakterden oluşmalıdır.',

            'instagram.required' => 'İnstagram kısmı zorunludur.',
            'instagram.string' => 'İnstagram kısmı metin tipinde olmalıdır.',
            'instagram.min' => 'İnstagram kısmı en az 10 karakterden oluşmalıdır.',

            'linkedIn.required' => 'LinkedIn kısmı zorunludur.',
            'linkedIn.string' => 'LinkedIn kısmı metin tipinde olmalıdır.',
            'linkedIn.min' => 'LinkedIn kısmı en az 10 karakterden oluşmalıdır.',

            'github.required' => 'Github kısmı zorunludur.',
            'github.string' => 'Github kısmı metin tipinde olmalıdır.',
            'github.min' => 'Github kısmı en az 10 karakterden oluşmalıdır.',

            'email.required' => 'Mail Adresi zorunludur.',
            'email.string' => 'Mail Adresi metin tipinde olmalıdır.',
            'email.email' => 'Mail Adresi geçerli bir mail adresi olmalıdır.',

            'tel.required' => 'Telefon numarası kısmı zorunludur.',
            'tel.integer' => 'Telefon numarası kısmı rakam tipinde olmalıdır.',
            'tel.min' => 'Telefon numarası kısmı en az 10 karakterden oluşmalıdır.',
            
            'adres.required' => 'Adres kısmı zorunludur.',
            'adres.string' => 'Adres kısmı metin tipinde olmalıdır.',
            'adres.min' => 'Adres kısmı en az 10 karakterden oluşmalıdır.',
            'adres.max' => 'Adres kısmı en fazla 100 karakterden oluşmalıdır.',
            
            'logo1.required' => 'Resim yüklemek zorunludur.',
            'logo1.image' => 'Sadece resim formatı geçerlidir.',
            'logo1.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',

            'logo2.required' => 'Resim yüklemek zorunludur.',
            'logo2.image' => 'Sadece resim formatı geçerlidir.',
            'logo2.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',
        ];
    }
}