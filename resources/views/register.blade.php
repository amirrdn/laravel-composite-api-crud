@extends('template')
<link href="{{asset('register.css')}}" rel="stylesheet">
@section('content')
    <div class="container mt-5 mb-5">

        <div class="row d-flex align-items-center justify-content-center">
    
            <div class="col-md-6">
    
    
                <div class="card px-5 py-5">
    
                    <span class="circle"><i class="fa fa-check"></i></span>
                    @if (\Session::has('message'))
                    <h5 class="mt-3">
                        {!! \Session::get('message') !!}
                    </h5>
                    @else
                        <h5 class="mt-3">Register Form</h5>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-input">
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email address" required/>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
        
                        <div class="form-input">
                            <input type="text" class="form-control @error('firstName') is-invalid @enderror" name="firstName" placeholder="first name" required/>
                            @error('firstName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <input type="text" class="form-control @error('lastName') is-invalid @enderror" name="lastName" placeholder="last name" required/>
                            @error('lastName')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="password" name="password" required autocomplete="current-password" />
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <input type="password" class="form-control @error('repeatPassword') is-invalid @enderror" placeholder="confirm password" name="repeatPassword" required autocomplete="current-password" />
                            @error('repeatPassword')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>    
                        <button class="btn btn-primary mt-4 signup">Submit</button>
                    </form>
    
                    <div class="text-center mt-3">
    
                        <span>Or continue with these social profile</span>
    
                    </div>

                    <div class="text-center mt-4">
    
                        <span>Already a member?</span>
                        <a href="#" class="text-decoration-none">Login</a>
    
                    </div>
    
                </div>
    
    
    
            </div>
    
        </div>
    
    </div>
@endsection