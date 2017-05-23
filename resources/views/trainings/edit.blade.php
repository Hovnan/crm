@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Обновление Занятия</h3>
            </div>
                <form id="training-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="name">
                                <label for="nom">Название занятия *</label>
                                <input class="form-control1" type="text" name="name" id="nom" placeholder="Гимнастика" value="{{ $training->name }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group" id="duration">
                                <label for="dur">Время *</label>
                                <input class="form-control1" type="text" name="duration" id="dur" value="{{ $training->duration }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" id="age">
                                <label for="ag">Возраст *</label>
                                <input class="form-control1 digit" type="text" name="age" id="ag" value="{{ $training->age }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group" id="cost">
                                <label for="co">Стоимость *</label>
                                <input class="form-control1" type="text" name="cost" id="co" value="{{ $training->cost }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" id="amount">
                                <label for="am">Кол-детей *</label>
                                <input class="form-control1" type="text" name="amount" id="am" value="{{ $training->amount }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div><!--
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group" id="days">
                                <label for="da">День недели *</label>
                                <select class="selectpicker" name="days" data-style="btn-default btn-sel" multiple data-max-options="7" id="da">
                                    <option value="1">Понедельник</option>
                                        <option value="2">Вторник</option>
                                        <option value="3">Среда</option>
                                        <option value="4" selected>Четверг</option>
                                        <option value="5">Пятница</option>
                                        <option value="6" selected>Суббота</option>
                                        <option value="7">Воскресенье</option>
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>-->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="employee_id">
                                <label for="emp">Тренер *</label>
                                <select class="form-control1" name="employee_id" id="emp">
                                    <option value="">Тренер не выбран</option>
                                    @foreach($employees as $employee)
                                        <option value="{{ $employee->id }}" {{ $employee->id == $training->employee_id ? 'selected' : '' }}>{{ $employee->name }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
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
    <script src="/js/timedropper.js"></script>
    <link rel="stylesheet" type="text/css" href="/style/timedropper.css">
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#training-form').submit(function(event){
            event.preventDefault();
            var postData = {
                "name": $('input[name=name]').val().toLowerCase(),
                "duration": $('input[name=duration]').val(),
                //"days": $('select[name=days]').val(),
                "age": $('input[name=age]').val(),
                "amount": $('input[name=amount]').val(),
                "cost": $('input[name=cost]').val(),
                "employee_id": $('select[name=employee_id]').val(),
                "old_name": "{{ strtolower($training->name) }}"
            };
            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' .help-block').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('training.update', ['branch' => $branch->id, 'id' => $training->id ]) }}",
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
        $( "#dur" ).timeDropper({
            format: 'H:mm'
        });
        $('.digit').mask('99');
        $('#am').mask('999');
        $('#co').mask('999999999');
    </script>
@stop