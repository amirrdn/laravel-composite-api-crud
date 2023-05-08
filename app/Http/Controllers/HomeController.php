<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->urls          = 'https://api-sport-events.php6-02.test.voxteneo.com/api/v1/';
    }
    //protected $urls                = 'https://api-sport-events.php6-02.test.voxteneo.com/api/v1/';
    public function index(Request $request)
    {
        $usersv                 = \Session::get('users');
        if($usersv){
            $client = new \GuzzleHttp\Client();
            $url = $this->urls."users/".$usersv->id;
            $headers = [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer '.$usersv->token
            ];
            $response = $client->request('GET', $url, [
                'http_errors'=>false,
                'headers' => $headers,
                'verify'  => false,
            ]);
            $users                  = json_decode($response->getBody());
            $token                  = $usersv->token;

            return view('home', compact('users', 'token'));
        }
        if(\Session::get('users')){
            $users              = \Session::get('users');
            $token              = null;

            return view('home', compact('users', 'token'));
        }else{
            return redirect()->route('login-form');
        }
    }
    public function checkusers()
    {

    }
}
