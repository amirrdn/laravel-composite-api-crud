<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="{{asset('style.css')}}" rel="stylesheet">
    <!-- Scripts -->
    <style>
        .table tr td img{
            width: 100%;
        }
        .table-event tr td:nth-child(5){
            width: 100px !important;
        }
        .table-event tr td:nth-child(7) .btn{
            float: left;
        }
        .table-organizer tr td:nth-child(3){
            width: 100px !important;
        }
        .list-group li a{
            text-decoration: none;
        }
    </style>
    @stack('stylesheets')
</head>
<body class="@if(\Request::route()->getName() === 'register') {{'snippet-body'}} @elseif(\Request::route()->getName() === 'login-form') {{'login'}}  @endif">
    <div class="content">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    @yield('script')
    @stack('scripts')
    
</body>
</html>