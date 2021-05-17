<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class SliderUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
         if($request->image==null){
            return [
                  
                  
                   'title'=>'required|string|min:5',
           ];
        }else{
            return [
                   'image'=>'image|mimes:jpg,jpeg,png,gif',
               
                   'title'=>'required|string|min:5',
           ];
        }
    }
    public function messages()
    {
        return [
            'title.required' => 'Başlık kısmı zorunludur.',
            'title.string' => 'Başlık kısmı metin tipinde olmalıdır.',
            'title.min' => 'Başlık kısmı en az 5 karakterden oluşmalıdır.',
            
            'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',
        ];
    }
}
