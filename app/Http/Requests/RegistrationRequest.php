<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            "username" => "required|alpha_dash|max:20|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required|confirmed|min:6"
        ];
    }

    public function messages()
    {
        return [
            "username.required" => "Please enter the username.",
            "username.alpha_dash" => "Username may contain only alpha-numeric characters, as well as dashes and underscores.",
            "username.max" => "Username must be no longer than 20 characters.",
            "username.unique" => "This username already exists.",
            "email.required" => "Please enter the e-mail.",
            "email.email" => "The field must be formatted as the e-mail address.",
            "email.unique" => "This e-mail already exists.",
            "password.required" => "Please enter the password.",
            "password.confirmed" => "Passwords do not match.",
            "password.min" => "Password must be at least 6 characters long."
        ];
    }
}
