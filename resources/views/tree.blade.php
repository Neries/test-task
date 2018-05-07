@extends ('layouts.master')

@section ('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.css" />
@endsection

@section ('content')


    <div class="container" style="width:900px;">
        <br>
        <div id="treeview"></div>
    </div>


@endsection

@section ('script')

    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-treeview/1.2.0/bootstrap-treeview.min.js"></script>

    <script>
        $(document).ready(function(){
            $.ajax({
                url: "{{ route('treeView') }}",
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