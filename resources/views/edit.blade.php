@extends ('layouts.master')

@section('content')


    <div id="form" class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-10 col-sm-offset-0 col-md-offset-1">
                <div  class="panel panel-default">
                    <div class="panel-body" style="background: #f4f4f4">
                        <form method="POST" action="/employees/edit/{{$employee->id}}">
                            {{ csrf_field() }}
                            <div class="form-group col-xs-4"> <!-- Last Name -->
                                <label for="last_name_id" class="control-label">Fitst Name</label>
                                <input type="text" class="form-control" id="last_name_id" name="last_name"
                                       placeholder="Иванов" value="{{$employee->last_name}}">
                            </div>

                            <div class="form-group col-xs-4"> <!-- First Name -->
                                <label for="first_name_id" class="control-label">First Name</label>
                                <input type="text" class="form-control" id="first_name_id" name="first_name"
                                       placeholder="Иван" value="{{$employee->first_name}}" required>
                            </div>

                            <div class="form-group col-xs-4"> <!-- Patronymic -->
                                <label for="patronymic_id" class="control-label">Patronymic</label>
                                <input type="text" class="form-control" id="patronymic_id" name="patronymic"
                                       placeholder="Иванович" value="{{$employee->patronymic}}" required>
                            </div>

                            <div class="form-group col-xs-4"> <!-- Position -->
                                <label for="position_id" class="control-label">Position</label>
                                <input type="text" class="form-control" id="position_id" name="position"
                                       placeholder="Бухгалтер" value="{{$employee->position}}" required>
                            </div>

                            <div class="form-group col-xs-3"> <!-- Employment Date -->
                                <label for="employment_date_id" class="control-label">Employment Date</label>
                                <input type="datetime-local" class="form-control" id="employment_date_id"
                                       name="employment_date"
                                       value="{{ date('Y-m-d\TH:i:s', strtotime($employee->employment_date))}}"
                                       required>
                            </div>

                            <div class="form-group col-xs-3"> <!-- Salary -->
                                <label for="salary_id" class="control-label">Salary</label>
                                <input type="number" step="0.01" class="form-control" id="salary_id" name="salary"
                                       placeholder="1234.12" value="{{$employee->salary}}" required>
                            </div>

                            <div class="form-group col-xs-2"> <!-- Chief_Id -->
                                <label for="chief_id" class="control-label">Chief Id</label>
                                <input type="number" step="1" class="form-control" id="chief_id" name="chief_id"
                                       placeholder="12" value="{{$employee->chief_id}}" required>
                            </div>


                            <div class="form-group"> <!-- Submit Button -->
                                <input type="submit" name="save" value="Save" class="btn btn-info btn-block">
                                <input type="submit" name="delete" value="Delete" class="btn btn-danger btn-block">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection