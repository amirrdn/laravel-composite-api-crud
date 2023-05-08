<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function __construct()
    {
        $this->urls             = 'https://api-sport-events.php6-02.test.voxteneo.com/api/v1/';
        $this->client           = new \GuzzleHttp\Client();
    }
    
    public function view(Request $request, $id)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];

        $uriusers                       = $this->urls."users/".$id;

        $usersjson                      = $this->client->request('GET', $uriusers, [
            'http_errors'=>false,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $users                          = json_decode($usersjson->getBody());
        return view('users.edit', compact('users'));
    }
    public function update(Request $request, $id)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];
        $params = [
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
        ];

        $uriusers                       = $this->urls."users/".$id;

        $usersjson                      = $this->client->request('PUT', $uriusers, [
            'http_errors'=>false,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $users                          = json_decode($usersjson->getBody());

        if ($usersjson->getStatusCode() === 422) {
            $msg                        = $jsonevent->errors;
            return redirect()->back()->with(['message' => json_encode($msg)]);
        }
        return redirect()->route('home')->with(['message' => 'success update']);
    }
    public function changepassword()
    {
        $users            = \Session::get('users');

        return view('users.changepassword', compact('users'));
    }
    public function updatePassword(Request $request, $id)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];
        $params = [
            'oldPassword' => $request->oldPassword,
            'newPassword' => $request->newPassword,
            'repeatPassword' => $request->repeatPassword,
        ];

        $uriusers                       = $this->urls."users/".$id."/password";

        $usersjson                      = $this->client->request('PUT', $uriusers, [
            'http_errors'=>false,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $users                          = json_decode($usersjson->getBody());
        if ($usersjson->getStatusCode() === 422) {
            $msg                        = $users->errors;
            return redirect()->back()->with(['message' => json_encode($msg)]);
        }
        return redirect()->route('home')->with(['message' => 'success update']);
    }
    public function destroy(Request $request, $id)
    {
        $usersv                         = \Session::get('users');

        $client                         = new \GuzzleHttp\Client();
        $url                            = $this->urls."users/".$id;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$usersv->token
        ];
        $response = $client->request('DELETE', $url, [
            'http_errors'=>false,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $insertdata = json_decode($response->getBody());
        return redirect()->route('login')->with(['message' => 'success delete']);
    }
}
