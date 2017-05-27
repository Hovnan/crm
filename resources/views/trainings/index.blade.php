@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Занятия</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <button data-toggle="modal" data-target="#add_session" type="button" class="btn btn-info btn-cust">Создать занятие</button>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="clearfix"> </div>
            </div>
            <table id="client_table" class="table table-bordered col-xs-12 text-center">
                <thead>
                <tr>
                    <th>N</th>
                    <th>Название занятия</th>
                    <th>Кол-детей</th>
                    <th>Длительность в минутах</th>
                    <th>Мин. возраст ребенка</th>
                    <th>Оплата тренера</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($trainings as $training)
                    <tr>
                        <td>{{ $training->id }}</td>
                        <td>{{ $training->name }}</td>
                        <td>{{ $training->amount }}</td>
                        <td>{{ $training->duration }}</td>
                        <td>{{ $training->age }}</td>
                        <td>{{ $training->cost }}</td>
                        <td>
                            <a href="{{ route('training.edit', ['branch' => $branch->id, 'id' => $training->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_session" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Создать занятие</h3>
                                <span class="f-type">Вам необходимо заполнить форму</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row" id="dir-row" style="display: none">
                            <div class="col-md-1">
                                <div class="form-group">
                                    <button class="btn btn-info btn-cust" type="button" style="margin-top: 24px" id="back-button"><i class="fa fa-chevron-left" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group" id="direction">
                                    <label for="dir-name">Новое направление *</label>
                                    <input type="text" class="form-control1" name="direction" id="dir-name">
                                    <span class="help-block"></span>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button class="btn btn-info btn-cust" type="button" style="margin-top: 24px" onclick="addDirection()">Add</button>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                        <form id="training-form">
                            @if($directs)
                            <div class="row" id="dir-div">
                                <div class="col-md-6">
                                    <div class="form-group" id="direction_id">
                                        <label for="dir">Направление занятий *</label>
                                        <select class="form-control1" name="direction_id" id="dir">
                                            <option selected>Не выбран</option>
                                            @foreach($directs as $direct)
                                                <option value="{{ $direct->id }}">{{ $direct->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-2" >
                                    <div class="form-group">
                                        <button class="btn btn-info btn-cust" type="button" style="margin-top: 24px" id="add-button">Add New</button>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="name">
                                        <label for="nom">Название занятия *</label>
                                        <input class="form-control1" type="text" name="name" id="nom">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="duration">
                                        <label for="dur">Длительность *</label>
                                        <input class="form-control1" type="text" name="duration" id="dur">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="age">
                                        <label for="ag">Мин возраст *</label>
                                        <input class="form-control1 digit" type="text" name="age" id="ag">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group" id="cost">
                                        <label for="co">Опл. тренера *</label>
                                        <input class="form-control1" type="text" name="cost" id="co">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="amount">
                                        <label for="am">Макс кол-детей *</label>
                                        <input class="form-control1" type="text" name="amount" id="am">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="employees">
                                        <div class="col-md-12" style="padding-left: 0">
                                            <label for="da">Тренеры *</label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 0">
                                            <select class="selectpicker" name="employees" data-style="btn-default btn-sel" multiple data-max-options="7" id="da">
                                                @foreach($employees as $employee)
                                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info pull-left btn-cust">Добавить</button>
                                </div>
                            </div>
                            @endif
                        </form>
                    </div>
                </div>
                <div class="modal-footer x-type">
                    <div class="container-fluid">
                        <!--<div class="row">
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-info pull-left btn-cust">Добавить</button>
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
    <link rel="stylesheet" href="/style/bootstrap-select.min.css">
    <script src="/js/bootstrap-select.min.js"></script>
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/css/bootstrap-select.min.css">-->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.7.5/js/bootstrap-select.min.js"></script>-->

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
                "direction_id": $('select[name=direction_id]').val(),
                "employees": $('select[name=employees]').val(),
                "age": $('input[name=age]').val(),
                "amount": $('input[name=amount]').val(),
                "cost": $('input[name=cost]').val()
            };
            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' .help-block').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('training.store', ['branch' => $branch->id]) }}",
                data: postData,
                success: function(response){
                    console.log(response);
                    window.location.href = response.redirect;
                },
                error: function(response){
                    var result = response.responseJSON.errors;
                    for(var k in result) {
                        //console.log(k, result[k]);
                        $('#'+k).addClass('has-error');
                        $('#' +k+ ' .help-block').text(result[k]);
                    }
                }
            });
        });
        $('#add-button').click(function(){
            $('#dir-div').hide();
            $('#dir-row').show();


        });
        $('#back-button').click(function(){
            $('#dir-div').show();
            $('#dir-row').hide();
            $('input[name=direction]').val('');
        });

        function addDirection () {
            //event.preventDefault();
            var postData = {
                "name": $('input[name=direction]').val().toLowerCase()
            };
            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' .help-block').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('direction.store', ['branch' => $branch->id]) }}",
                data: postData,
                success: function(response){
                    //window.location.href = response.redirect;
                    $('#dir-row').hide();
                    $('#dir-div').show();
                    $('input[name=direction]').val('');
                    $('select[name=direction_id] option').removeAttr('selected');
                    $('select[name=direction_id]').append('<option value="'+response.id+'" selected>'+response.name+'</option>')

                   // $('#t').val('1').prop('selected', true);
                    console.log(response);

                },
                error: function(response){

                    //console.log(response);
                    var result = response.responseJSON.errors;

                    for(var k in result) {
                        console.log(k, result[k]);
                        $('#direction').addClass('has-error');
                        $('#direction .help-block').text(result[k]);
                    }
                }
            });
        }/*
        $( "#dur" ).timeDropper({
            format: 'H:mm'
        });*/
        $('.digit').mask('99');
        $('#am').mask('999');
        $('#dur').mask('999');
        $('#co').mask('999999999');
    </script>
@stop