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
        $data = $request->only(['email', 'password']);
        $dataForToken = [
            'username' => $data['email'],
            'password' => $data['password']
        ];
        $dataToken = $this->getToken($dataForToken);
        return json_encode($request->all());
    }

    protected function getToken($data)
    {
        $http = new \GuzzleHttp\Client;
        $params = array_merge($data,[
            'grant_type' => 'password',
            'client_id' => config('auth.passport.grand.client_id'),
            'client_secret' => config('auth.passport.grand.client_secret'),
        ]);
        $response = $http->post(url('oauth/token'), [
            'form_params' => $params,
        ]);


        return json_decode((string) $response->getBody(), true);
        // die('stop');
    }

}
