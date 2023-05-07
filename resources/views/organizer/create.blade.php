@extends('template')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-sm-12">
            <h5>Create Orgainzer</h5>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        @if (\Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {!! \Session::get('message') !!}
                        </div>
                        @endif
                    </div>
                    {{ method_field('post') }}
                    {!! Form::open(['autocomplete'=> 'off','method' => 'POST','route' => ['store-organizer'], 'class'=> 'row g-3 submit-form needs-validation','role' => 'form', 'novalidate', 'enctype' => 'multipart/form-data'])  !!}
                    {{ csrf_field() }}
                    @include('organizer.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection