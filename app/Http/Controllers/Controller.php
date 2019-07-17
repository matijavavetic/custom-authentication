<?php
namespace App\Http\Controllers;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Routing\Redirector;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\AuthManager as Auth;
use Illuminate\Mail\Mailer;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * The request instance
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;
    /**
     * The response instance
     *
     * @var \Illuminate\Contracts\Routing\ResponseFactory
     */
    protected $responseFactory;
    /**
     * The storage instance
     *
     * @var \Illuminate\Filesystem\FilesystemManager $storage
     */
    protected $storage;

    /**
     * The auth instance
     *
     * @var \Illuminate\Auth\AuthManager $auth
     */
    protected $auth;

    /**
     * The mail instance
     *
     * @var \Illuminate\Mail\Mailer $mail
     */
    protected $mail;

    /**
     * The redirect instance
     *
     * @var \Illuminate\Routing\Redirector $redirect
     */
    protected $redirect;

    /**
     * The session instance
     *
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;
    /**
     * Create new controller instance
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \Illuminate\Session\SessionManager $session
     * @param  \Illuminate\Contracts\Routing\ResponseFactory  $response
     * @param \Illuminate\Auth\AuthManager $auth
     * @param \Illuminate\Mail\Mailer $mail
     * @param \Illuminate\Routing\Redirector $redirect
     * @return void
     */
    public function __construct(SessionManager $session, Request $request, Response $response, Auth $auth, Redirector $redirect, Mailer $mail)
    {
        $this->request = $request;
        $this->session = $session;
        $this->responseFactory = $response;
        $this->auth = $auth;
        $this->mail = $mail;
        $this->redirect = $redirect;
    }
}