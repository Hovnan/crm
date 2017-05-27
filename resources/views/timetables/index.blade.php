@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Расписание</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <button data-toggle="modal" data-target="#add_schedule" type="button" class="btn btn-info btn-cust">Добавить занятие</button>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="clearfix"> </div>
            </div>
            <table id="client_table" class="table table-bordered col-xs-12 text-center">
                <thead>
                <tr>
                    <th>Ч/М</th>
                    <th class="me">Понедельник</th>
                    <th class="me">Вторник</th>
                    <th class="me">Среда</th>
                    <th class="me">Четверг</th>
                    <th class="me">Пятница</th>
                    <th class="me">Суббота</th>
                    <th class="me">Воскресенье</th>
                    <!--<th>Действия</th>-->
                </tr>
                </thead>
                <tbody>
                @foreach($timetables as $timetable)

                    <tr>
                        <td>{{ $timetable->time }}</td>
                        @foreach($week as $k => $v)
                            <td>{{  in_array($k, $timetable->day) ? $timetable->trainings->name : '' }}</td>
                        @endforeach
                        <!--<td>
                            <a href="{{ route('timetable.edit', ['branch' => $branch->id, 'id' => $timetable->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>-->
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_schedule" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Добавить занятие</h3>
                                <span class="f-type">Вам необходимо заполнить форму</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="timetable-form">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="direction_id">
                                        <label for="dir">Направление занятий *</label>
                                        <select class="form-control1" name="direction_id" id="dir">
                                            <option value="">Не выбран</option>
                                            @foreach($directions as $direction)
                                                <option value="{{ $direction->id }}">{{ $direction->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row training">

                            </div>
                            <div class="row time" style="display:none">
                                <div class="col-md-3">
                                    <div class="form-group" id="time">
                                        <label for="dur">Время *</label>
                                        <input class="form-control1" type="text" name="time" id="dur">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row day" style="display:none">
                                <div class="col-md-3">
                                    <div class="form-group" id="day">
                                        <label for="da">День недели *</label>
                                        <select class="selectpicker" name="day" data-style="btn-default btn-sel" multiple data-max-options="7" id="da">
                                            <option value="1">Понедельник</option>
                                            <option value="2">Вторник</option>
                                            <option value="3">Среда</option>
                                            <option value="4">Четверг</option>
                                            <option value="5">Пятница</option>
                                            <option value="6">Суббота</option>
                                            <option value="7">Воскресенье</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row employee">

                                    </div>
                            <div class="row but" style="display:none">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info pull-left btn-cust">Добавить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer x-type">
                    <div class="container-fluid">
                        <!--<div class="row">
                            <div class="col-md-8">
                                <button type="button" class="btn btn-info pull-left btn-cust">Добавить</button>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.Modal-->

@stop


@section('scripts')
    <!--<script src="/js/timedropper.js"></script>
    <link rel="stylesheet" type="text/css" href="/style/timedropper.css">-->
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
                url:"{{ route('timetable.store', ['branch' => $branch->id]) }}",
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
        });/*
        $('.selectpicker').selectpicker({
            style: 'btn-info',
            size: 4
        });*/
        $('#dir').on('change', function(){
            var id = $('select[name=direction_id]').val() ? $('select[name=direction_id]').val() : null;

            if(id){
                var postData = {
                    "id": id
                };/*
                 for(var k in postData) {
                 $('#' + k).removeClass('has-error');
                 $('#' + k + ' .help-block').text('');
                 };*/
                $.ajax({
                    type: 'POST',
                    url:"{{ route('direction.show', ['branch' => $branch->id]) }}",
                    data: postData,
                    success: function(response){
                        //window.location.href = response.redirect;
                        $('.training').html(response);

                    },
                    error: function(response){
                        var result = response.responseJSON.errors;

                        for(var k in result) {
                            $('#'+k).addClass('has-error');
                            $('#'+ k +' .help-block').text(result[k]);
                        }
                    }
                });
            }else{
                $('.training').html('');
                $('.employee').html('');
                $('.day').hide();
                $('.time').hide();
                $('.but').hide();
            }
            return false

        });
         function showEmployees() {
             var id = $('select[name=training_id]').val() ? $('select[name=training_id]').val(): null;
             if(id){
             var postData = {
                 "id": id
             };
             /*
              for(var k in postData) {
              $('#' + k).removeClass('has-error');
              $('#' + k + ' .help-block').text('');
              };*/
             $.ajax({
                 type: 'POST',
                 url: "{{ route('training.show', ['branch' => $branch->id]) }}",
                 data: postData,
                 success: function (response) {
                     //window.location.href = response.redirect;

                     //$('.employee').show();
                     $('.employee').html(response);
                     $('.employee select').selectpicker('refresh');

                     $('.day').show();
                     $('.time').show();
                     $('.but').show();

                 },
                 error: function (response) {
                     var result = response.responseJSON.errors;

                     for (var k in result) {
                         $('#' + k).addClass('has-error');
                         $('#' + k + ' .help-block').text(result[k]);
                     }
                 }
             });
         }else{
                 $('.employee').html('');
             }
             return false
        };
        /*$(function (){
            $.mask.definitions['H']='[012]';
            $.mask.definitions['M']='[012345]';
            $('#dur').mask('H9:M9',{
                        placeholder: "_",
                        completed: function()
                        {
                            var val = $(this).val().split(':');
                            if ( val[0]*1 > 23) val[0] = '23';
                            if ( val[1]*1 > 59) val[1] = '59';
                            $(this).val( val.join(':') );
                        }
                    }
            );
        });*/
        $('#dur').mask('H9:M9', {'translation': {
            H: {pattern: /[012]/},
            M: {pattern: /[012345]/}
            }
        });
        var c = $('#client_table').width();
        $('.me').css('width', Math.floor((c-70)/7))

    </script>
@stop