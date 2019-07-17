<?php

namespace App\Http\Controllers;

use App\Mail\LostPasswordMail;
use App\User;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /**
     * Shows reset password form to the user
     *
     * @return \Illuminate\Http\Response
     */
    public function showLinkRequestForm()
    {
        return $this->responseFactory->view('auth.passwords.email');
    }

    /**
     * Sends user the e-mail to reset the password
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws
     */
    public function sendResetLinkEmail()
    {
        $findUser = new User();

        $user = $findUser->where('email', $this->request->input('email'))->first();

        if ($user->exists()) {
            $user['lost_password_token'] = bin2hex(random_bytes(50));
            $user->save();
            $this->mail->to($user['email'])->send(new LostPasswordMail($user));
            $this->session->flash('success', 'E-mail for recovering the password has been sent.');
        }

        return $this->responseFactory->redirectTo('home');
    }

    /**
     * Shows user the form to enter new password
     *
     * @param string $token
     * @return \Illuminate\Http\Response
     */
    public function showResetForm(string $token)
    {
        return $this->responseFactory->view('auth.passwords.reset', compact('token'));
    }

    /**
     * Saves user's new password and redirects
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(string $token)
    {
        $findUser = new User();

        $user = $findUser->where('lost_password_token', $token)->first();

        if ($token === $user['lost_password_token']) {
            $user['password'] = $this->request->input('password');
            $user['lost_password_token'] = null;
            $user->save();
            $this->session->flash('success', 'Your password has been reset.');
        } else {
            $this->session->flash('danger', 'Token doesnt match the user found.');
            return $this->responseFactory->redirectTo('password/reset/{token}');
        }

        return $this->responseFactory->redirectTo('home');
    }
}
