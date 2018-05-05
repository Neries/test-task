@extends ('layouts.master')

@section ('content')
    <h1>Employees page</h1>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap.min.css">


    <table id="datatable" class="table table-striped table-condensed table-bordered table-hover">
        <thead>
        <tr class="info">
            <th>ID</th>
            <th>Last name</th>
            <th>First name</th>
            <th>Patronymic</th>
            <th>Position</th>
            <th>Employment date</th>
            <th>Salary</th>
            <th>Edit</th>
        </tr>
        </thead>

        <tbody>
        </tbody>
    </table>

    <script type="text/javascript" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
            src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap.min.js"></script>
    <script>

        $(document).ready(function () {
            var table = $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('employees.json') }}",
                    type: "POST",
                    data: {"_token": "{{ csrf_token() }}"}
                },
                columns: [
                    {data: "id"},
                    {data: "last_name"},
                    {data: "first_name"},
                    {data: "patronymic"},
                    {data: "position"},
                    {data: "employment_date"},
                    {data: "salary"},
                    {defaultContent: "<div class='btn-group'><a id ='edit' class='btn btn-info btn-sm'>Edit</a>" +
                        "<a id ='del' class='btn btn-danger btn-sm'>Del</a></div>"}
                ]
            });
            $('#datatable tbody').on('click', '[id*=edit]', function () {
                var data = table.row($(this).parents('tr')).data();
                var id = data.id;
                window.location.href = "{{ route('employees') }}" + '/edit/' + id;
            });

            $('#datatable tbody').on('click', '[id*=del]', function () {
                var data = table.row($(this).parents('tr')).data();
                var id = data.id;
                window.location.href = "{{ route('employees') }}" + '/delete/' + id;
            });
        });



    </script>


@endsection


