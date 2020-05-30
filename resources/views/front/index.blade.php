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

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }

            .mb-0{
                margin-bottom: 0%;
            }

            .mb-5{
                margin-bottom: 3rem;
            }

            .mt-0{
                margin-top: 0%;
            }
            
            .links-btn{
                padding: 10px 30px !important;
            }

            .links-btn:hover{
                background-color: #6C7477;
                color: #fff;

                border-radius: 100px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <div class="content">

                <img src="{{ asset('storage/MLG_Logo-Since-1999.jpg') }}" alt="MLG Logo">

                <div class="title m-b-md mb-0">
                    This is a Restricted Area.
                </div>
                <h3 class="mt-0 mb-5">Please go back to the front page or login with your credentials.</h3>

                @if (Route::has('login'))
                    <div class="links">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="links-btn">Home</a>
                        @else
                            <a href="{{ route('login') }}" class="links-btn">Login</a>
                            <a href="https://mlgcl.edu.ph" class="links-btn">Front Page</a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
