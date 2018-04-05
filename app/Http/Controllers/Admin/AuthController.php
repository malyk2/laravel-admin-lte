<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Login as RequestLogin;

class AuthController extends Controller
{
    public function login(RequestLogin $request)
    {
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
            'client_id' => '2',
            'client_secret' => 'cj5S56MZZQWTTvNWg2wM8Nh7eukgmd3iHEL3U9pg',
        ]);
        $response = $http->post(url('oauth/token'), [
            'form_params' => $params,
        ]);
        //print_r($response->getBody()); die();

        print_r(json_decode((string) $response->getBody(), true)); die();

        return json_decode((string) $response->getBody(), true);
        die('stop');
    }

}
