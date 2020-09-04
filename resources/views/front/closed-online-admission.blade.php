<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" xmlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Francis Gelsano">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MLGCL | Online Admission Closed</title>
    @include('front.partials._external-styles')
    @include('front.partials._internal-styles')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.14.4/dist/sweetalert2.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css">

    <meta property="og:image" content="{{ asset('admin/img/MLG_Logo-Since-1999.jpg')}}" />
    <meta property="og:image:width" content="450"/>
    <meta property="og:image:height" content="298"/>

</head>

<body>
    <div class="main">
        <div class="container">
            @include('front.partials._heading-block')
            
            <div class="alert alert-danger text-center p-5">
                <h1>Sorry...Online Admission is already closed.</h1>
            </div>
        </div>
    </div>

</body>

</html>