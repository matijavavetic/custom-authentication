<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationFormRequest;
use App\User;
use App\Mail\VerifyMail;

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

        $this->mail->to(request('email'))->send(new VerifyMail($userData));

        return redirect()->to('/home');
    }

    public function confirmMailForm(string $token)
    {
        return view('auth.verifyMail', compact('token'));
    }

    public function confirmation(string $token)
    {
        $user = new User();
        $thisUser = $user->where('email', request(['email']))->first();

        if ($token === $thisUser->verificationToken) {
            $thisUser->confirmed = true;
            $thisUser->save();
        }

        return view('welcome');
    }
}