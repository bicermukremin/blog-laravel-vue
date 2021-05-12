<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
                    'image'=>'required|image|mimes:jpg,jpeg,png,gif',
                   'description'=>'required|string|min:15|max:3000',
                   'author_description'=>'required|string|min:15|max:300',
                   'title'=>'required|string|min:5',

        ];
    }
    public function messages()
    {
        return [
            'title.required' => 'Başlık kısmı zorunludur.',
            'title.string' => 'Başlık kısmı metin tipinde olmalıdır.',
            'title.min' => 'Başlık kısmı en az 5 karakterden oluşmalıdır.',
            
            'description.required' => 'İçerik kısmı zorunludur.',
            'description.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'description.min' => 'İçerik kısmı en az 15 karakterden oluşmalıdır.',
            'description.max' => 'İçerik kısmı en fazla 3000 karakterden oluşmalıdır.',

            'author_description.required' => 'İçerik kısmı zorunludur.',
            'author_description.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'author_description.min' => 'İçerik kısmı en az 15 karakterden oluşmalıdır.',
            'author_description.max' => 'İçerik kısmı en fazla 300 karakterden oluşmalıdır.',
            
            'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',
        ];
    }
}