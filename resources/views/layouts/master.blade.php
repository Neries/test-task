<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ config('app.name', 'Employee') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/shortcut.png') }}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    @yield ('style')

</head>
<body>

@include ('layouts.nav')

<div class="container" style="margin-top: 50px">

    <div class="row">

        @yield ('content')

    </div>

</div>

@include ('layouts.footer')

<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield ('script')
</body>
</html>
