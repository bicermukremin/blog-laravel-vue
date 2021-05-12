<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutRequest extends FormRequest
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
                'description'=>'required|string|min:10|max:3000',
                'mission'=>'required|string|min:10|max:1500',
                'vision'=>'required|string|min:10|max:1500',
                'history_content'=>'required|string|min:10|max:3000',
                'title'=>'required|string|min:5',
                /* 'history_items'=>'required|string|min:5', */
                /* 'image'=>'required|image|mimes:jpg,jpeg,png,gif|max:1024*1024*2', */

        ];
    }

     public function messages()
    {
        return [
             'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',
            'image.max' => 'Resimler 2 MB boyutu geçmemelidir.',

            'title.required' => 'Başlık kısmı zorunludur.',
            'title.string' => 'Başlık kısmı metin tipinde olmalıdır.',
            'title.min' => 'Başlık kısmı en az 5 karakterden oluşmalıdır.',
            
            'history_items.required' => 'Kronoloji kısmı zorunludur.',
            'history_items.string' => 'Kronoloji kısmı metin tipinde olmalıdır.',
            'history_items.min' => 'Kronoloji kısmı en az 5 karakterden oluşmalıdır.',
            
            'description.required' => 'Açıklama kısmı zorunludur.',
            'description.string' => 'Açıklama kısmı metin tipinde olmalıdır.',
            'description.min' => 'Açıklama kısmı en az 15 karakterden oluşmalıdır.',
            'description.max' => 'Açıklama kısmı en fazla 70 karakterden oluşmalıdır.',
           
            'mission.required' => 'Misyon kısmı zorunludur.',
            'mission.string' => 'Misyon kısmı metin tipinde olmalıdır.',
            'mission.min' => 'Misyon kısmı en az 15 karakterden oluşmalıdır.',
            'mission.max' => 'Misyon kısmı en fazla 70 karakterden oluşmalıdır.',
            
            'vision.required' => 'Vizyon kısmı zorunludur.',
            'vision.string' => 'Vizyon kısmı metin tipinde olmalıdır.',
            'vision.min' => 'Vizyon kısmı en az 15 karakterden oluşmalıdır.',
            'vision.max' => 'Vizyon kısmı en fazla 70 karakterden oluşmalıdır.',
            
            'history_content.required' => 'İçerik kısmı zorunludur.',
            'history_content.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'history_content.min' => 'İçerik kısmı en az 15 karakterden oluşmalıdır.',
            'history_content.max' => 'İçerik kısmı en fazla 1500 karakterden oluşmalıdır.',
            
            
        ];
    }
}