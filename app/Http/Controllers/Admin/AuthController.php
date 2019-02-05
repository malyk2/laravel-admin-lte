<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\AuthService;
use App\Http\Requests\Admin\Login as RequestLogin;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(RequestLogin $request)
    {
        return $this->authService->login($request);
    }
}
