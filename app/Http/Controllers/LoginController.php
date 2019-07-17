<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginFormRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    /**
     * Shows login form to the guest
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return $this->responseFactory->view('auth.login');
    }

    /**
     * Logs in the user if they exist
     *
     * @param LoginFormRequest $request
     * @return RedirectResponse
     */
    public function login(LoginFormRequest $request)
    {
        $userData = $request->validateData();

        if (! $this->auth->attempt($userData)) {
            return $this->responseFactory->redirectToAction('LoginController@login');
        }

        return $this->responseFactory->redirectToAction('home');
    }

    /**
     * Logs out the user
     *
     * @return RedirectResponse
     */
    public function logout()
    {
        if ($this->auth->check()) {
            $this->auth->logout();
        }

        return $this->responseFactory->redirectToAction('home');
    }
}