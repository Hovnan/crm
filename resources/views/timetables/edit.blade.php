@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Обновление Занятия</h3>
            </div>
                <form id="timetable-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="training_id">
                                <label for="tr">Название занятия *</label>
                                <select class="form-control1" name="training_id" id="tr">
                                    <option value="">Select Training</option>
                                    @foreach($trainings as $training)
                                        <option value="{{ $training->id }}" {{ $training->id == $timetable->training_id ? 'selected' : '' }}>{{ $training->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-1">
                            <div class="form-group" id="time">
                                <label for="dur">Время *</label>
                                <input class="form-control1" type="text" name="time" id="dur" value="{{ $timetable->time }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group" id="day">
                                <label for="da">День недели *</label>
                                <select class="selectpicker" name="day" data-style="btn-default btn-sel" multiple data-max-options="7" id="da">
                                    @foreach($week as $k => $v)
                                        <option value="{{ $k }}" {{  in_array($k, $timetable->day) ? 'selected' : '' }}>{{  $v }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="employee_id">
                                <label for="emp">Тренер *</label>
                                <select class="form-control1" name="employee_id" id="emp">
                                    <option value="">Select Trainer</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == $timetable->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info pull-left btn-cust">Добавить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

@stop
@section('scripts')
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">-->
    <link rel="stylesheet" href="/style/bootstrap-select.min.css">
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>-->
    <script src="/js/bootstrap-select.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#timetable-form').submit(function(event){
            event.preventDefault();
            var postData = {
                "day": $('select[name=day]').val(),
                "time": $('input[name=time]').val(),
                "training_id": $('select[name=training_id]').val(),
                "employee_id": $('select[name=employee_id]').val()
            };
            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' .help-block').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('timetable.update', ['branch' => $branch->id, 'id' => $timetable->id]) }}",
                data: postData,
                success: function(response){
                    window.location.href = response.redirect;
                },
                error: function(response){
                    var result = response.responseJSON.errors;

                    for(var k in result) {
                        $('#'+k).addClass('has-error');
                        $('#'+ k +' .help-block').text(result[k]);
                    }
                }
            });
        });
        $('#dur').mask('H9:M9', {'translation': {
            H: {pattern: /[012]/},
            M: {pattern: /[012345]/}
        }
        });
    </script>
@stop