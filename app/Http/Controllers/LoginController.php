<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function views()
    {
        return view('login');
    }
    public function login(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        $url = "https://api-sport-events.php6-02.test.voxteneo.com/api/v1/users/login";
        $headers = [
            'Content-Type' => 'application/json',
            'X-CSRF-TOKEN' => $request->_token
        ];
        $params = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        $response = $client->request('POST', $url, [
            'http_errors'=>false,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $users  = json_decode($response->getBody());
        if($response->getStatusCode() === 422){
            $responses  = (string) $response->getBody();
            $responses1 = json_decode($responses, true);
            $message    = $responses1['errors']['password'];
            return redirect()->back()->with(['message' => json_encode($message)]);
        }
        \Session::put('users', $users);
        $credentials = $request->only('email', 'password');
        $request->session()->regenerate();
        return redirect()->route('home');
    }
}
