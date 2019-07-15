<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationFormRequest;
use App\User;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return $this->responseFactory->view('auth.register');
    }

    public function register(RegistrationFormRequest $request)
    {
        $userData = $request->validateData();

        $user = new User();

        $user->create($userData);

        $this->auth->attempt($userData);

        return $this->responseFactory->view('welcome');
    }
}