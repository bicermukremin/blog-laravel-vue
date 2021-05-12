<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
            'content'=>'required|string|min:10',
            /* 'image'=>'required|image|mimes:jpg,jpeg,png,gif', */
        ];
    }
     public function messages()
    {
        return [
            'content.required' => 'İçerik kısmı zorunludur.',
            'content.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'content.min' => 'İçerik kısmı en az 5 karakterden oluşmalıdır.',
            
            
            /* 'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ', */
        ];
    }
}