<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrgainizerController extends Controller
{
    public function __construct()
    {
        $this->urls          = 'https://api-sport-events.php6-02.test.voxteneo.com/api/v1/';
        $this->client           = new \GuzzleHttp\Client();
    }
    public function index(Request $request)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];

        $uriorganizer           = $this->urls."organizers?page=".$request->page."&perPage=".$request->per_page;

        $reorganizer = $this->client->request('GET', $uriorganizer, [
            'http_errors'=>false,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $organizerv                  = json_decode($reorganizer->getBody());
        $organizer                      = $organizerv->data;
        $paginatoror                    = $organizerv->meta;

        return view('organizer.index', compact('organizer', 'paginatoror'));
    }
    public function create()
    {
        return view('organizer.create');
    }
    public function store(Request $request)
    {
        $usersv                 = \Session::get('users');

        $client = new \GuzzleHttp\Client();
        $url = "https://api-sport-events.php6-02.test.voxteneo.com/api/v1/organizers";
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$usersv->token
        ];
        $params = [
            'organizerName' => $request->organizerName,
            'imageLocation' => $request->imageLocation
        ];
        $response = $client->request('POST', $url, [
            'http_errors'=>false,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $insertdata = json_decode($response->getBody());
        return redirect()->route('organizer')->with(['message' => 'success insert']);;
    }
    public function view($id)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];

        $url              = $this->urls."organizers/".$id;

        $vieworganizer = $this->client->request('GET', $url, [
            'http_errors'=>false,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $organizerv                  = json_decode($vieworganizer->getBody());

        return view('organizer.edit', compact('organizerv'));
    }
    public function update(Request $request, $id)
    {
        $usersv                 = \Session::get('users');

        $client = new \GuzzleHttp\Client();
        $url = $this->urls."organizers/".$id;
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$usersv->token
        ];
        $params = [
            'organizerName' => $request->organizerName,
            'imageLocation' => $request->imageLocation
        ];
        $response = $client->request('PUT', $url, [
            'http_errors'=>false,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $insertdata = json_decode($response->getBody());
        return redirect()->route('organizer')->with(['message' => 'success update']);
    }
    public function destroy(Request $request, $id)
    {
        $usersv                 = \Session::get('users');

        $client = new \GuzzleHttp\Client();
        $url = $this->urls."organizers/".$id;
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
        return redirect()->route('organizer')->with(['message' => 'success delete']);
    }
}
