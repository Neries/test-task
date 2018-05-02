@extends ('layouts.master')

@section ('content')
    <h1>Employees page</h1>

    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

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
        </tr>
        </thead>

        <tbody>
        </tbody>
    </table>

    <script type="text/javascript" charset="utf8"
            src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script>

        $(document).ready(function () {
            $('#datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": "{{ route('api.employees.index') }}",
                "columns": [
                    {"data": "id"},
                    {"data": "last_name"},
                    {"data": "first_name"},
                    {"data": "patronymic"},
                    {"data": "position"},
                    {"data": "employment_date"},
                    {"data": "salary"}
                ]
            });
        });
    </script>

@endsection

