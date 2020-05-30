<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Francis Gelsano">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>MLGCL | Online Admission</title>
    @include('front.partials._external-styles')
    @include('front.partials._internal-styles')

</head>

<body>

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

    @include('front.partials._internal-js-scripts')
</body>

</html>