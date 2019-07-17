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
    public function show()
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
        $data = $request->validateData();

        $data['verificationToken'] = bin2hex(random_bytes(50));

        $user = new User();

        $user->create($data);

        $this->mail->to($data['email'])->send(new VerifyMail($data));

        return $this->responseFactory->redirectTo('home');
    }

    /**
     * Shows user the form to confirm their mail
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function showConfirmationForm(string $token)
    {
        return $this->responseFactory->view('auth.verification.verifyMail', compact('token'));
    }

    /**
     * Finds user by their e-mail and confirms their account based on verification token
     *
     * @param string $token
     * @return RedirectResponse
     */
    public function confirm(string $token)
    {
        $user = new User();

        $data = [
            'user' => $user,
            'token' => $token
        ];

        $data['user'] = $user->where('email', request('email'))->first();

        if ($data['token'] === $data['user']['verificationToken']) {
            $data['user']['confirmed'] = 1;
            $data['user']->save();
        } else {
            return $this->responseFactory->redirectToAction('RegisterController@showConfirmationForm');
        }

        return $this->responseFactory->redirectToAction('LoginController@login');
    }
}