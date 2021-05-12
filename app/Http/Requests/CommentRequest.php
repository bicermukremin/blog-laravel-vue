<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
                   
                   'description'=>'required|string|min:15|max:195',
                  
           ];
        
    }

        public function messages()
    {
        return [
          
            'description.required' => 'İçerik kısmı zorunludur.',
            'description.string' => 'İçerik kısmı metin tipinde olmalıdır.',
            'description.min' => 'İçerik kısmı en az 15 karakterden oluşmalıdır.',
            'description.max' => 'İçerik kısmı en fazla 195 karakterden oluşmalıdır.',
            
            
        ];
    }
}