@extends ('layouts.master')

@section ('style')
    <link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')


    <div id="form" class="container">
        <div class="row centered-form">
            <div class="col-xs-12 col-sm-8 col-md-10 col-sm-offset-0 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title" align="center">{{ isset($employee) ? 'Edit' : 'Create' }}
                        </h3>
                    </div>
                    <div class="panel-body" style="background: #f9f9f9">
                        <form method="POST"
                              action="{{ isset($employee) ? route('save', ['id' => $employee->id]) : route('save') }}"
                              enctype="multipart/form-data">

                            {{ csrf_field() }}

                            <input type="hidden" name="id" value="{{ $employee->id ?? '' }}">


                            <div class="form-group col-md-3">
                                <div class="text-center">
                                    <img id="img" src="{{ $employee->avatar ?? '//via.placeholder.com/200x200' }}"
                                         class="form-group img-thumbnail" style="max-width: 200px; max-height: 200px"
                                         alt="avatar">

                                    <label class="form-group btn-block btn btn-primary">
                                        Upload photo <input type="file" id="imgInp" name="avatar" hidden>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group col-xs-4"> <!-- Last Name -->
                                <label for="last_name_id" class="control-label">Fitst Name</label>
                                <input type="text" class="form-control" id="last_name_id" name="last_name"
                                       placeholder="Иванов" value="{{  $employee->last_name ?? ''}}">
                            </div>

                            <div class="form-group col-xs-4"> <!-- First Name -->
                                <label for="first_name_id" class="control-label">First Name</label>
                                <input type="text" class="form-control" id="first_name_id" name="first_name"
                                       placeholder="Иван" value="{{ $employee->first_name ?? ''}}"
                                       required>
                            </div>

                            <div class="form-group col-xs-4"> <!-- Patronymic -->
                                <label for="patronymic_id" class="control-label">Patronymic</label>
                                <input type="text" class="form-control" id="patronymic_id" name="patronymic"
                                       placeholder="Иванович" value="{{ $employee->patronymic ?? ''}}"
                                       required>
                            </div>

                            <div class="form-group col-xs-4"> <!-- Position -->
                                <label for="position_id" class="control-label">Position</label>
                                <input type="text" class="form-control" id="position_id" name="position"
                                       placeholder="Бухгалтер" value="{{ $employee->position ?? ''}}"
                                       required>
                            </div>

                            <div class="form-group col-xs-4"> <!-- Employment Date -->
                                <label for="employment_date_id" class="control-label">Employment Date</label>
                                <input type="datetime-local" class="form-control" id="employment_date_id"
                                       name="employment_date" placeholder="1999-12-31T23:59:59"
                                       value="{{ isset($employee) ? date('Y-m-d\TH:i', strtotime($employee->employment_date)) : ''}}"
                                       required>
                            </div>

                            <div class="form-group col-xs-4"> <!-- Salary -->
                                <label for="salary_id" class="control-label">Salary</label>
                                <input type="number" step="0.01" class="form-control" id="salary_id" name="salary"
                                       placeholder="1234,12" value="{{ $employee->salary ?? '' }}"
                                       required>
                            </div>


                            <div class="form-group col-xs-8"> <!-- Chief_Id -->
                                <label for="chief_id" class="control-label">Chief</label>
                                <select class="form-control chief-list-ajax" id="chief_id" name="chief_id">
                                    @if(!empty($chief))
                                        <option value="{{ $chief['id'] }}">{{ $chief['text'] }}</option>
                                    @endif
                                </select>
                            </div>

                            <div class="form-group"> <!-- Buttons -->
                                <input type="submit" value="Save" class="btn btn-info btn-block">
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection

@section('script')

    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });

        $('.chief-list-ajax').select2({
            minimumInputLength: 2,
            ajax: {
                url: '{{ route('filterEmployees') }}',
                dataType: 'json',
                delay: 200
            }
        });
    </script>

@endsection
