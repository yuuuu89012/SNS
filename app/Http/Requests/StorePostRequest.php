<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
        'title'=>[
            'string',
            'required',
            'max:30',
        ],
        'image'=>[
            'required',
            'mimes:jpg,jpeg,png',
            'file',
        ],
        'description'=>[
            'string',
            'required',
            'max:100',
        ],
        'category' => [ 
            'string',
            'required',
                
        
        ],
    ];
    }
}
