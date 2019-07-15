<?php
namespace App\Http\Controllers;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory as Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Auth\AuthManager as Auth;
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
     * Create new controller instance
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Routing\ResponseFactory  $response
     * @param  \Illuminate\Filesystem\FilesystemManager $storage
     * @param \Illuminate\Auth\AuthManager $auth
     * @return void
     */
    public function __construct(Request $request, Response $response, Auth $auth)
    {
        $this->request = $request;
        $this->responseFactory = $response;
        $this->auth = $auth;
    }
}