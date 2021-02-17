<?php


namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Validator\LoginValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Client;

class LoginController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = Client::find(2);
    }

    public function login(Request $request)
    {
        $validator = new LoginValidator();
        if ($response = $validator->validate())
            return $response;
        $params = [
            'grant_type' => 'password',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'username' => $request->email,
            'password' => $request->password,
        ];

        $request->request->add($params);

        $proxy = Request::create('oauth/token', 'POST');

        $response = Route::dispatch($proxy);
        if ($response->getStatusCode() == 200)
        {
            return response()->json()
                ->setData(json_decode($response->getContent()))
                ->setStatusCode(200)
                ->setCharset('utf-8')
                ->header('Content-Type', 'application/javascript')
                ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
        }

        return response()->json()
            ->setData(json_decode($response->getContent()))
            ->setStatusCode(401)
            ->setCharset('utf-8')
            ->header('Content-Type', 'application/javascript')
            ->setEncodingOptions(JSON_UNESCAPED_UNICODE);
    }

    public function refresh(Request $request)
    {
        $params = [
            'grant_type' => 'refresh_token',
            'client_id' => $this->client->id,
            'client_secret' => $this->client->secret,
            'refresh_token' => $request->refresh_token
        ];

        $request->request->add($params);
        $proxy = Request::create('oauth/token', 'POST');
        return Route::dispatch($proxy);
    }

    public function logout(Request $request)
    {
        if (Auth::check())
        {
            Auth::user()->AauthAcessToken()->delete();
        }
    }
}
