<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{

    public function showLoginForm()
    {
        return $this->responseFactory->view('auth.login');
    }

    public function login(LoginFormRequest $request)
    {
        $userData = $request->validateData();

        if ($this->auth->attempt($userData)){
            return $this->responseFactory->view('welcome');
        }

        return $this->responseFactory->view('login')-with('Wrong email/password');
}

    public function logout()
    {
        $this->auth->logout();

        return $this->responseFactory->view('welcome');
    }
}