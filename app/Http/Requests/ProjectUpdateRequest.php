<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProjectUpdateRequest extends FormRequest
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
       /*  dd($request->image); */
        if($request->image==null){
            return [
                  
                    'company_name'=>'required|string|min:3',
                    'service_id'=>'required',
           ];
        }else{
            return [
                   'image'=>'required|image|mimes:jpg,jpeg,png,gif',
                    'company_name'=>'required|string|min:3',
                    'service_id'=>'required',
           ];
        }
    }

        public function messages()
    {
        return [
            'company_name.required' => 'Başlık kısmı zorunludur.',
            'company_name.string' => 'Başlık kısmı metin tipinde olmalıdır.',
            'company_name.min' => 'Başlık kısmı en az 3 karakterden oluşmalıdır.',
            
            'service_id.required' => 'Bir hizmet seçmeniz zorunludur.',
            
            'image.required' => 'Resim yüklemek zorunludur.',
            'image.image' => 'Sadece resim formatı geçerlidir.',
            'image.mimes' => 'Resimler jpg,jpeg,png,gif formatında olmalıdır. ',
        ];
    }
}