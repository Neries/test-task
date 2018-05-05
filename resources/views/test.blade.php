{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<title>Webslesson Tutorial | Make Treeview using Bootstrap Treeview Ajax JQuery with PHP</title>--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>--}}
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />--}}
{{--</head>--}}
{{--<body>--}}

@extends ('layouts.master')

@section ('content')


<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />


<div class="container" style="width:900px;">
    <br />
    <div id="treeview"></div>
</div>



<script>
    $(document).ready(function(){
        $.ajax({
            url: "{{ route('test') }}",
            method:"POST",
            dataType: "json",
            data: {"_token": "{{ csrf_token() }}"},
            success: function(data)
            {
                $('#treeview').treeview({data: data});
            }
        });

    });
</script>

@endsection