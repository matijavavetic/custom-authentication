<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /**
     * Shows user the form to confirm their mail
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function show(string $token)
    {
        return $this->responseFactory->view('auth.mailconfirmation', compact('token'));
    }

    /**
     * Finds user by their e-mail and confirms their account based on verification token
     *
     * @param string $token
     * @return RedirectResponse
     */
    public function confirm(string $token)
    {
        $findUser = new User();

        $user = $findUser->where('email', $this->request->input('email'))->first();

        if ($token === $user['verificationToken']) {
            $user['confirmed'] = 1;
            $user['verificationToken'] = null;
            $user->save();
            $this->session->flash('success', 'Your account has been confirmed successfully.');
        } else {
            $this->session->flash('danger', 'Verification token doesnt match the user found');
            return $this->responseFactory->redirectTo('confirmation/{token}');
        }

        return $this->responseFactory->redirectToAction('LoginController@login');
    }
}
