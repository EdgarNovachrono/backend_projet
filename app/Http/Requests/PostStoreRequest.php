<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if (request()->isMethod('post')) {
            return [
                //
                'image'=>'required|image|mimes:png,jpg,jpeg|max:2048'
            ];

        }
       else{
        return [
            //
            'image'=>'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ];

       }
    }
    public function messages()
    {
        if (request()->isMethod('post')) {
            # code...
            return[
                 'image.required' => 'image est stocke'
            ];
           
        }
    }
}
