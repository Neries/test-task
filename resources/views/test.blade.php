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