<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationFormRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed'
        ];
    }

    public function validateData()
    {
        $input = [
            'name' => request('name'),
            'password' => request('password'),
            'email' => request('email'),
            'verificationToken' => bin2hex(random_bytes(50))
        ];

        return $input;
    }
}
