<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvatarUpdateRequest extends FormRequest
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
            "avatar" => "image|mimes:jpg,png,jpeg|max:2048"
        ];
    }

    public function messages()
    {
        return [
            "avatar.image" => "The file must be an image.",
            "avatar.mimes" => "The file must have one of the following mime types: jpg, png, jpeg.",
            "avatar.max" => "The file size must be no more than 2MB."
        ];
    }
}
