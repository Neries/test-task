<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Employees</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <link href="{{ asset('css/treeview.css') }}" rel="stylesheet">
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
@yield ('script')
</body>
</html>
