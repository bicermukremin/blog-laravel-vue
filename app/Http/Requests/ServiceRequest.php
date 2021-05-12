<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'images'=>'required',
                'content'=>'required|string|min:15|max:1500',
                'title'=>'required|string|min:5',
                'items'=>'required|string|min:5',
                

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Başlık kısmı zorunludur.',
            'title.string' => 'Başlık kısmı metin tipinde olmalıdır.',
            'title.min' => 'Başlık kısmı en az 5 karakterden oluşmalıdır.',

            'items.required' => 'Aşama kısmı zorunludur.',
            'items.string' => 'Aşama kısmı metin tipinde olmalıdır.',
            'items.min' => 'Aşama kısmı en az 5 karakterden oluşmalıdır.',
            
            'content.required' => 'İçerik kısmı zorunludur.',
            'content.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'content.min' => 'İçerik kısmı en az 15 karakterden oluşmalıdır.',
            'content.max' => 'İçerik kısmı en fazla 1500 karakterden oluşmalıdır.',
            
            'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',
        ];
    }
}