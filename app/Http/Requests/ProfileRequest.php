<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
                'avatar'=>'image|mimes:jpg,jpeg,png,gif',
                'about'=>'required|string|min:15|max:300',
                'facebook'=>'active_url',
                'twitter'=>'active_url',
                'youtube'=>'active_url',
                'instagram'=>'active_url',
                'linkedIn'=>'active_url',

        ];
    }
    public function messages()
    {
        return [

            
            'about.required' => 'İçerik kısmı zorunludur.',
            'about.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'about.min' => 'İçerik kısmı en az 15 karakterden oluşmalıdır.',
            'about.max' => 'İçerik kısmı en fazla 195 karakterden oluşmalıdır.',

            'facebook.active_url' => 'Facebook adresiniz geçerli bir domain adresi olmalıdır.',
            'twitter.active_url' => 'Twitter adresiniz geçerli bir domain adresi olmalıdır.',
            'youtube.active_url' => 'Youtube adresiniz geçerli bir domain adresi olmalıdır.',
            'instagram.active_url' => 'İnstagram adresiniz geçerli bir domain adresi olmalıdır.',
            'linkedIn.active_url' => 'LinkedIn adresiniz geçerli bir domain adresi olmalıdır.',
            
         
            'avatar.image' => 'Sadece resim formatı geçerlidir.',
            'avatar.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',
        ];
    }
}