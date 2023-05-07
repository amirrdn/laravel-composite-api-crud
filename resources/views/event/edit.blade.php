@extends('template')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-sm-12">
            <h5>Create Orgainzer</h5>
            <div class="card">
                <div class="card-body">
                    {{ method_field('PUT') }}
                    {!! Form::model($event, ['autocomplete'=> 'off','method' => 'PUT','route' => ['update-event', $event->id], 'class'=> 'row g-3 submit-form needs-validation','role' => 'form', 'novalidate', 'enctype' => 'multipart/form-data'])  !!}
                    {{ csrf_field() }}
                    {{ Form::hidden('id',null, ['class' => 'form-control', 'name' => 'id', 'required']) }}
                    @include('event.form')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection