<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationFormRequest;
use App\User;
use App\Mail\VerifyMail;

class RegisterController extends Controller
{
    /**
     * Shows registration form to the guest
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
    {
        return $this->responseFactory->view('auth.register');
    }

    /**
     * Validates data and stores newly registered user
     *
     * @param RegistrationFormRequest $request
     * @return RedirectResponse
     * @throws
     */
    public function register(RegistrationFormRequest $request)
    {
        $userData = $request->validateData();

        $user = new User();

        $user->create($userData);

        $this->mail->to(request('email'))->send(new VerifyMail($userData));

        return $this->redirect->to('home');
    }

    /**
     * Shows user the form to confirm their mail
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function confirmMailForm(string $token)
    {
        return $this->responseFactory->view('auth.verification.verifyMail', compact('token'));
    }

    /**
     * Finds user by their e-mail and confirms their account based on verification token
     *
     * @param string $token
     * @return RedirectResponse
     */
    public function confirmation(string $token)
    {
        $user = new User();

        $thisUser = $user->where('email', request(['email']))->first();

        if ($token === $thisUser->verificationToken) {
            $thisUser->confirmed = 1;
            $thisUser->save();
        } else {
            return $this->redirect->back();
        }

        return $this->redirect->to('login');
    }
}