<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Francis Gelsano">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MLGCL | Online Admission</title>
    @include('front.partials._external-styles')
    @include('front.partials._internal-styles')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.4/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css">

    <meta property="og:image" content="{{ asset('admin/img/MLG_Logo-Since-1999.jpg')}}" />
    <meta property="og:image:width" content="450"/>
    <meta property="og:image:height" content="298"/>

</head>

<body>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId            : '954577641649557',
                autoLogAppEvents : true,
                xfbml            : true,
                version          : 'v7.0'
            });
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));       
    </script>
    <script async defer src="https://connect.facebook.net/en_US/sdk.js"></script>
    <img src="{{ asset('front/images/loading-spinner.gif') }}" alt="Loading" id="loading-spinner" class="img-responsive" width="10%">
    <div class="main">
        <div class="container">
            @include('front.partials._heading-block')
            
            @include('front.partials._disclaimer-block')

            @include('front.partials._admission-container')

            @include('front.partials._confirmation-box')

            @include('front.partials._submitted-form')
        </div>
    </div>

    @include('front.partials._selfie-modal')

    @include('front.partials._external-js-scripts')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.4/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/src/js/dropify.min.js"></script>

    @include('front.partials._internal-js-scripts')

    <div class="fb-customerchat"
        page_id="116630946756485"
        minimized="true">
    </div>
    <script>
        window.fbAsyncInit = function() {
        FB.init({
            appId            : '954577641649557',
            autoLogAppEvents : true,
            xfbml            : true,
            version          : 'v2.11'
        });
        };
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
        attribution=setup_tool
        page_id="116630946756485"
        theme_color="#BE59B9">
    </div>
</body>

</html>