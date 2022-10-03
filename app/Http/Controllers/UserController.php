<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UtilsService;
use App\Services\UserService;

class UserController extends Controller
{
    private $user_service;
    private $utils_service;

    public function __construct(UtilsService $utils_service, UserService $user_service)
    {
        $this->utils_service = $utils_service;
        $this->user_service = $user_service;
    }

    public function login(Request $request)
    {
        $login = $this->user_service->login($request);

        return $login;
    }

    public function autentication(Request $request)
    {
        $cookie = $request->token;
        $auth = $this->user_service->userAutentication($cookie);

        return $auth;
    }
    

}
