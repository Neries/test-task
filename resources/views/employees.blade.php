@extends ('layouts.master')

@section ('content')
<h1>Employees page</h1>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css">


<table  id="example" class="table table-striped table-condensed table-bordered table-hover">
    <thead>
    <tr class="info">
        <th><a href="#">ID</a></th>
        <th><a href="#">Фамилия</a></th>
        <th><a href="#">Имя</a></th>
        <th><a href="#">Отчество</a></th>
        <th><a href="#">Должность</a></th>
        <th><a href="#">Дата приема на работу</a></th>
        <th><a href="#">Зарплата</a></th>
    </tr>
    </thead>

    <tbody>
    @foreach($employees as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->last_name }}</td>
            <td>{{ $item->first_name }}</td>
            <td>{{ $item->patronymic }}</td>
            <td>{{ $item->position }}</td>
            <td>{{ date("Y-m-d", strtotime($item->employment_date)) }}</td>
            <td>{{ $item->salary }}</td>
        </tr>

    @endforeach

    </tbody>
</table>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script>
    $(function(){
        $("#example").dataTable();
    })
</script>



@endsection

