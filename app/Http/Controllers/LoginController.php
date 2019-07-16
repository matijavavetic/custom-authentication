<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Shows login form to the guest
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return $this->responseFactory->view('auth.login');
    }

    /**
     * Logs in the user if they exist
     *
     * @param LoginFormRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginFormRequest $request)
    {
        $userData = $request->validateData();

        if ($this->auth->attempt($userData)){
            return $this->responseFactory->view('welcome');
        }

        return $this->responseFactory->view('login')-with('Wrong email/password');
}
    /**
     * Logs out the user
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        $this->auth->logout();

        return $this->responseFactory->view('welcome');
    }
}