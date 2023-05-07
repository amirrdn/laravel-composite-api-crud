<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class RegisterController extends Controller
{
    public function store(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = "https://api-sport-events.php6-02.test.voxteneo.com/api/v1/users";
        $headers = [
            'Content-Type' => 'application/json',
            'X-CSRF-TOKEN' => $request->_token
        ];
        $params = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => $request->password,
            'repeatPassword' => $request->repeatPassword
        ];
        $response = $client->request('POST', $url, [
            'http_errors'=>false,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $regusers = json_decode($response->getBody());
        if ($response->getStatusCode() === 422) {
            $msg = array_values($regusers->errors->email);
            return redirect()->back()->with(['message' => json_encode($msg)]);
        }
        \Session::put('users', $regusers);
        $credentials = $request->only('email', 'password');
        $request->session()->regenerate();
        
        return redirect()->route('home')
        ->withSuccess('You have successfully registered & logged in!');
        

    }
}
