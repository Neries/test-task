@extends ('layouts.master')

@section ('content')


    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <h1>Employees List</h1>
                    <ul id="tree1">
                    @foreach($employees as $i => $employee)
                            <li style="list-style-type: none">
                                <div class="list-group-item flex-column align-items-start">
                                    <div  class="list-group-item" data-id="{{ $employee->id }}">
                                        <kbd>ФИО</kbd>
                                        {{ ' '.$employee->last_name.' '.$employee->first_name.' '.$employee->patronymic }}
                                        <br>
                                        <kbd>должность</kbd>
                                        <nobr class="text-primary"> {{ ' '.$employee->position }} </nobr>
                                    </div>

                                    @if(!empty($employee->children))
                                    @include('branch',['children' => $employee->children])
                                    @endif

                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    {{--'<div  class="list-group-item"><kbd>ФИО</kbd>'.--}}
    {{--' '. $row["last_name"] . ' ' . $row["first_name"] . ' ' . $row['patronymic'] .--}}
    {{--' '.'<kbd>должность</kbd><nobr class="text-primary">'.--}}
    {{--' '.$row['position'].'</nobr></div>'--}}



    <script>
        {{--$('#table').on('click', function () {--}}
            {{--var parent = $(this);--}}

            {{--var data = {};--}}
            {{--data['_token'] = "{{ csrf_token() }}";--}}
            {{--data['id'] = parent.data('id');--}}

            {{--$.ajax({--}}
                {{--type: "POST",--}}
                {{--url: '{{ route('child') }}',--}}
                {{--data: data,--}}
                {{--success: function (response) {--}}
                    {{--$.each(response, function (i, item) {--}}
                        {{--var block = $('<div>', {--}}
                            {{--'id': "table",--}}
                            {{--'class': "list-group-item",--}}
                            {{--'data-id': item.id--}}
                        {{--});--}}
                        {{--block.append($('<kbd>', {text: 'ФИО'}));--}}
                        {{--block.append(' ' + item.last_name + ' ' + item.first_name + ' ' + item.patronymic);--}}
                        {{--block.append('<br>');--}}
                        {{--block.append($('<kbd>', {text: 'должность'}));--}}
                        {{--block.append($('<nobr>', {'class': 'text-primary', text: item.position}));--}}
                        {{--parent.append(block);--}}
                    {{--})--}}

                {{--},--}}
                {{--dataType: 'json'--}}
            {{--});--}}

        {{--});--}}

    </script>


@endsection