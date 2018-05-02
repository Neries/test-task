@extends ('layouts.master')

@section ('content')


    <div class="container">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <h1>Employees List</h1>
                    <ul id="tree1">
                        @foreach($employees as $i => $employee)
                            <li>
                                <div class="list-group-item flex-column align-items-start">
                                    <div class="list-group-item">
                                        <kbd>ФИО</kbd>
                                        {{ ' '.$employee->last_name.' '.$employee->first_name.' '.$employee->patronymic }}
                                        <br>
                                        <kbd>должность</kbd>
                                        <nobr class="text-primary"> {{ ' '.$employee->position }} </nobr>
                                    </div>

                                    @if(!empty($employee->children))
                                        @include('branch',['children' => $employee->children])
                                    @endif
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>




    {{--<script src="{{ asset('js/treeview.js') }}"></script>--}}

@endsection