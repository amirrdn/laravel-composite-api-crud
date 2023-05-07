@extends('template')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-sm-12">
            <h5>Welcome {{$users->firstName}}</h5>
            <ul class="list-group">
                <li class="list-group-item active" aria-current="true">Menu</li>
                <li class="list-group-item"><a href="{{route('organizer')}}">Orgainzer</a></li>
                <li class="list-group-item"><a href="{{route('event')}}">Sport Event</a></li>
            </ul>
            
        </div>
    </div>
@endsection