@extends('template')

@section('content')
    <div class="container mt-5 mb-5">
        <div class="col-sm-12">
            <h5>Change Password</h5>
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        @if (\Session::has('message'))
                        <div class="alert alert-success" role="alert">
                            {!! \Session::get('message') !!}
                        </div>
                        @endif
                    </div>
                    {{ method_field('PUT') }}
                    {!! Form::open(['autocomplete'=> 'off','method' => 'PUT','route' => ['update-password', $users->id], 'class'=> 'row g-3 submit-form needs-validation','role' => 'form', 'novalidate', 'enctype' => 'multipart/form-data'])  !!}
                    {{ csrf_field() }}
                        <div class="mb-3">
                            <label class="form-label">Old Password</label>
                            <input type="password" class="form-control @error('oldPassword') is-invalid @enderror" placeholder="old password" name="oldPassword" required />
                            @error('oldPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Password</label>
                            <input type="password" class="form-control @error('newPassword') is-invalid @enderror" placeholder="new password" name="newPassword" required />
                            @error('newPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Repeat Password</label>
                            <input type="password" class="form-control @error('repeatPassword') is-invalid @enderror" placeholder="repeat password" name="repeatPassword" required />
                            @error('repeatPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-sm btn-primary float-end ms-1">Submit</button>
                            <a href="{{str_replace(url('/'), '', url()->previous())}}" class="btn btn-sm btn-warning float-end">Cancel</a>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection