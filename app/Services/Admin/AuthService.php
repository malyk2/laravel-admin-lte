<?php

namespace App\Services\Admin;

use App\Services\CoreService;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Repositories\UserRepository;
use App\User;
use App\Http\Resources\Admin\User\Short as UserShortResourse;

class AuthService extends CoreService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $data = $request->only(['email', 'password']);

        if (auth()->attempt($data)) {

            $me = auth()->user();

            $tokens = $this->getPassportTokens($data);

            $result = (new UserShortResourse($me))->additional(compact('tokens'));

            return response()->result($result, 'You was successfully logged in');

        } else {
            customThrow('Incorrect email or password', 422);
        }
    }

    public function register(Request $request)
    {
        $data = [
            'name' => '',
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'status' => User::STATUS_NEW,
        ];

        $user = $this->userRepository->itemCreate($data);

        $hash = $this->userRepository->addRandomHash($user, Hash::TYPE_VERIFY);
        $verifyLink = str_replace('{hash}', $hash, $request->link);

        event(new AuthRegisterEvent($user, $verifyLink));

        return response()->result(true, 'Your account was successfully created');
    }

    protected function getPassportTokens(array $data)
    {
        $client = new Client;

        $passwordParams = [
            'form_params' => [
                'grant_type' => 'password',
                'client_id' => config('auth.passport.grand.client_id'),
                'client_secret' => config('auth.passport.grand.client_secret'),
                'username' => array_get($data, 'email'),
                'password' => array_get($data, 'password'),
                'scope' => '*',
            ],
            'http_errors' => false,
        ];

        $response = $client->post(url('oauth/token'), $passwordParams);

        $result = json_decode($response->getBody()->getContents());

        customThrowIf( ! $result || empty($result->access_token), $result->message ?? 'Can\'t get token');

        return $result;
    }
}