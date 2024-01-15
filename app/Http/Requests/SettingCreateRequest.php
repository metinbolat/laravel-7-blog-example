<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SettingCreateRequest extends FormRequest
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
        if ($request->hasFile('value')) {
            return [
            'value' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            ];
        } else {
            return [
            'value' => 'required|max:350',
        ];
                }
        
        
    }

    public function messages()
    {
        return [
            'value.max' => 'The text should not be greater than 350 characters',
            'value.image' => 'The file should be an image',
            'value.mimes' => 'The image extension should be any of these: .jpg, .jpeg or .png',
            'value.max' => 'Image size should not be greater than 2048 KB',
        ];
    }
}
