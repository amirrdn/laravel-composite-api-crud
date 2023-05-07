<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
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

        $urievent                       = $this->urls."sport-events?page=".$request->page."&perPage=".$request->per_page;

        $eventjson                      = $this->client->request('GET', $urievent, [
            'http_errors'=>false,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $eventresource                   = json_decode($eventjson->getBody());
        $event                      = $eventresource->data;
        $paginator                    = $eventresource->meta;
        return view('event.index', compact('event', 'paginator'));
    }
    public function create(Request $request)
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
        $organizerv                     = json_decode($reorganizer->getBody());
        $organizer                      = $organizerv->data;
        return view('event.create', compact('organizer'));
    }
    public function store(Request $request)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];
        $params = [
            'eventDate' => date('Y-m-d', strtotime($request->eventDate)),
            'eventType' => $request->eventType,
            'organizerId' => $request->organizerId,
            'eventName' => $request->eventName,
        ];

        $urievent                       = $this->urls."sport-events";

        $eventstore                     = $this->client->request('POST', $urievent, [
            'http_errors'=>false,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $jsonevent                      = json_decode($eventstore->getBody());
        
        if ($eventstore->getStatusCode() === 422) {
            $msg                        = $jsonevent->errors;
            return redirect()->back()->with(['message' => json_encode($msg)]);
        }
        return redirect()->route('event')->with(['message' => 'success insert']);
    }
    public function view(Request $request, $id)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];

        $urievent                       = $this->urls."sport-events/".$id;

        $eventjson                      = $this->client->request('GET', $urievent, [
            'http_errors'=>false,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $event                          = json_decode($eventjson->getBody());

        $uriorganizer           = $this->urls."organizers?page=".$request->page."&perPage=".$request->per_page;

        $reorganizer = $this->client->request('GET', $uriorganizer, [
            'http_errors'=>false,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $organizerv                     = json_decode($reorganizer->getBody());
        $organizer                      = $organizerv->data;

        return view('event.edit', compact('event', 'organizer'));
    }
    public function update(Request $request, $id)
    {
        $users            = \Session::get('users');
        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer '.$users->token
        ];
        $params = [
            'eventDate' => date('Y-m-d', strtotime($request->eventDate)),
            'eventType' => $request->eventType,
            'organizerId' => (int)$request->organizerId,
            'eventName' => $request->eventName,
        ];

        $urievent                       = $this->urls."sport-events/".$id;

        $eventstore                     = $this->client->request('PUT', $urievent, [
            'http_errors'=>true,
            'json' => $params,
            'headers' => $headers,
            'verify'  => false,
        ]);
        $jsonevent                      = json_decode($eventstore->getBody());
        if ($eventstore->getStatusCode() === 422) {
            $msg                        = $jsonevent->errors;
            return redirect()->back()->with(['message' => json_encode($msg)]);
        }
        return redirect()->route('event')->with(['message' => 'success update']);
    }
    public function destroy(Request $request, $id)
    {
        $usersv                 = \Session::get('users');

        $client = new \GuzzleHttp\Client();
        $url = $this->urls."sport-events/".$id;
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
        return redirect()->route('event')->with(['message' => 'success delete']);
    }
}
