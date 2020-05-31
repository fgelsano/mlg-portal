<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>MLGCL | Portal</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        {{-- Favicon --}}
        <link rel="icon" type="image/png" href="{{ asset('admin/img/favicon.png') }}">

        {{-- Bootstrap CSS --}}
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

        {{-- Roboto Font --}}
        <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,700;0,900;1,500&display=swap" rel="stylesheet">

        <style>
            body{
                font-family: 'Roboto', sans-serif;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row text-center">
                <div class="col-12 col-md-4 offset-md-4 text-center my-5 px-3">
                    <img src="{{ asset('storage/MLG_Logo-Since-1999.jpg') }}" alt="MLG Logo" class="img-responsive" width="70%">
                </div>
                <div class="col-12 text-uppercase">
                    <h1 class="font-weight-bold">This is a Restricted Area.</h1>
                </div>
                <div class="col-12">
                    <p class="lead">Please go back to the front page or login with your credentials</p>
                </div>
                <div class="col-12 my-3">
                    @if (Route::has('login'))
                        <div class="links">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="btn btn-default">Home</a>
                            @else
                                <a href="{{ route('login') }}" class="btn btn-default">Login</a>
                                <a href="https://mlgcl.edu.ph" class="btn btn-default">Front Page</a>
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </body>
</html>
