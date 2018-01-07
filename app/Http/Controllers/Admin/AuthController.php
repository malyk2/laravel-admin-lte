<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login as RequestLogin;

class AuthController extends Controller
{
    public function login(RequestLogin $request)
    {
        return json_encode($request->all());
    }
}
