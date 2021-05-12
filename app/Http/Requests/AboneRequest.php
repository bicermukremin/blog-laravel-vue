<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboneRequest extends FormRequest
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
            'email'=>'required|email|string',
            /* 'image'=>'required|image|mimes:jpg,jpeg,png,gif', */
        ];
    }
     public function messages()
    {
        return [
            'email.required' => 'Mail adresi kısmı zorunludur.',
            'email.string' => 'Mail adresi kısmı metin tipinde olmalıdır.',
            'email.email' => 'Lütfen geçerli bir mail adresi giriniz.',
            
            
            /* 'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ', */
        ];
    }
}