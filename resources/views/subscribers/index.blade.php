@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Абонементы</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="">
                            <button data-toggle="modal" data-target="#add_abonement" type="button" class="btn btn-info btn-cust">Добавить карту</button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('subscriber.search', ['branch' => $branch->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 grid_box1">
                                <div class="row">
                                    <div class="col-md-12 grid_box1">
                                <label class="control-label" for="">Поиск</label></div></div>
                                 <div class="row">
                                    <div class="col-md-12" >
                                        <div class="col-md-8" style="padding-left: 0">
                                            <input name="search" type="text" class="form-control1" placeholder="ФИО, Телефон, Номер карты" value="{{ old('search') }}" autocomplete="off">
                                        </div>
                                        <div class="col-md-2">
                                            <button type="submit" class="btn btn-info btn-cust">&nbsp; Найти &nbsp;</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <hr />
                    <div class="clearfix"> </div>
                </form>
            </div>
            <table id="branch_table" class="table table-bordered col-xs-12 text-center">
                <thead>
                <tr>
                    <th style="width: 50px;">N</th>
                    <th class="me">Название</th>
                    <th style="width: 170px;">Тип</th>
                    <th style="width: 150px;">Цена</th>
                    <th style="width: 150px;">Кол-во продаж</th>
                    <th style="width: 180px;">Кол-во посещений</th>
                    <th style="width: 150px;">Срок действия</th>
                    <th style="width: 150px;">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscribers as $subscriber)
                    <tr>
                        <td>{{ $subscriber->id }}</td>
                        <td>{{ $subscriber->name }}</td>
                        <td>{{ $subscriber->type ? 'Не фиксированный' : 'Фиксированный' }}</td>
                        <td>{{ $subscriber->price }} руб</td>
                        <td>{{ $subscriber->childs->count() }}</td>
                        <td>{{ $subscriber->visits ? $subscriber->visits : 'Неограниченное' }}</td>
                        <td>{{ $subscriber->validity ? $subscriber->validity : 'Неограниченное' }}</td>
                        <td>
                            <a href="{{ route('subscriber.edit', ['branch' => $branch->id, 'id' => $subscriber->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_abonement" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Создать карту</h3>
                                <span class="f-type">Вам необходимо заполнить форму</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="subscriber-form">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="type">
                                        <label class="control-label" for="t">Тип абонемента *</label>
                                        <select class="form-control1 mySelect" id="t" name="type">
                                            <option value="0">Не выбран</option>
                                            <option value="1">Фиксировании</option>
                                            <option value="2">Не фиксировании</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row type-0" style="display: none;">
                                <div class="col-md-8">
                                    <div class="form-group" id="name">
                                        <label for="nom">Название карты *</label>
                                        <input class="form-control1" type="text" name="name" id="nom">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row type-2" style="display: none;">

                                <p style="padding-left: 15px;">Количество посещений *</p>
                                <div class="col-md-4">
                                    <div class="form-group" id="to">
                                        <label class="control-label" for="ot">От</label>
                                        <input type="text" class="form-control1" name="to" id="ot">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="from">
                                        <label class="control-label" for="do">До</label>
                                        <input type="text" class="form-control1" name="from" id="do">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row type-1" style="display: none;">
                                <div class="col-md-8">
                                    <div class="form-group" id="visits">
                                        <div class="col-md-12" style="padding-left: 0;">
                                            <label for="vis">Количество посещений *</label>
                                        </div>
                                        <div class="col-md-4 dd" style="padding-left: 0;">
                                            <input class="form-control1 digit" type="text" name="visits" id="vis">
                                        </div>
                                        <div class="checkbox-inline1 col-md-6 col-md-offset-2">
                                            <label><input type="checkbox" name="check-date">Неограниченное</label>
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row type-0" style="display: none;">
                                <div class="col-md-8">
                                    <div class="form-group" id="validity">
                                        <div class="col-md-12" style="padding-left: 0;">
                                            <label for="date">Срок действия (в месяцах)*</label>
                                        </div>
                                        <div class="col-md-4 nn" style="padding-left: 0;">
                                            <input class="form-control1" type="text" name="validity" id="date">
                                        </div>
                                        <div class="checkbox-inline1 col-md-6 col-md-offset-2">
                                            <label><input type="checkbox" name="check">Неограниченное</label>
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row type-0" style="display: none;">
                                <div class="col-md-8">
                                    <div class="form-group" id="freeze">
                                        <div class="col-md-12" style="padding-left: 0;">
                                            <label for="frez">Заморозка (в днях)</label>
                                        </div>
                                        <div class="col-md-4 ff" style="padding-left: 0;">
                                            <input class="form-control1" type="text" name="freeze" id="frez">
                                        </div>
                                        <div class="checkbox-inline1 col-md-6 col-md-offset-2">
                                            <label><input type="checkbox" name="check-frez">Неограниченное</label>
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row type-0" style="display: none;">

                                <div class="col-md-8">
                                <div class="form-group" id="price">
                                <div class="col-md-12" style="padding-left: 0">
                                        <label for="pr" id="price-int">Цена *</label>
                                    </div>
                                        <div class="col-md-4" style="padding-left: 0">
                                            <input class="form-control1 " type="text" name="price" id="pr">
                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row type-0" style="display: none;">
                                <div class="col-md-8">
                                    <div class="form-group" id="trainings">
                                        <div class="col-md-12" style="padding-left: 0">
                                            <label for="da">Занятия </label>
                                        </div>
                                        <div class="col-md-12" style="padding-left: 0">
                                        <select class="selectpicker" name="trainings" data-style="btn-default btn-sel" multiple data-max-options="7" id="da">
                                            @foreach($directions as $direction)
                                                @foreach($direction->trainings as $training)
                                                    <option value="{{ $training->id }}">{{ $training->name }}</option>
                                                    @endforeach
                                                @endforeach
                                        </select>

                                        </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row type-0" style="display: none; margin-top: 15px;">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info pull-left btn-cust">Добавить</button>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer x-type">
                    <div class="container-fluid">
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
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#subscriber-form').submit(function(event){
            event.preventDefault();
            var t = $('#t').val();
            var type = (t == 2) ? 1 : 0;
            var postData = {
                "name": $('input[name=name]').val().toLowerCase(),
                "validity": $('input[name=check]').is(':checked')? 0 : $('input[name=validity]').val(),
                "type": type,
                "freeze": $('input[name=check-frez]').is(':checked')? 0 : $('input[name=freeze]').val(),
                "trainings": $('select[name=trainings]').val(),
                "price": $('input[name=price]').val()
            };

            if (t == 1) {
                postData["visits"] = $('input[name=check-date]').is(':checked')? 0 : $('input[name=visits]').val();
            }else {
                postData["visits"] = $('input[name=to]').val() + '-' + $('input[name=from]').val();
            }

            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' span').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('subscriber.store', ['branch' => $branch->id]) }}",
                data: postData,
                success: function(response){
                    window.location.href = response.redirect;
                },
                error: function(response){
                    var result = response.responseJSON.errors;
                   // console.log(result);

                    for(var k in result) {
                        //console.log(k, result[k]);
                        $('#'+k).addClass('has-error');
                        $('#'+ k +' span').text(result[k]);
                    }
                }
            });
        });
        //$(function(){

        $('input[name="check-date"]').on('change',function(){
            if($('input[name="check-date"]').is(":checked")){
                $('.dd > input').val('');
                $('.dd > input').attr("disabled", "disabled");
            }else{
                $('.dd > input').removeAttr("disabled", "disabled");
            }
        });

        $('input[name="check"]').on('change',function(){
            if($('input[name="check"]').is(":checked")){
                //$('.nn').hide();
                $('.nn > input').val('');
                $('.nn > input').attr("disabled", "disabled");
            }else{
                $('.nn > input').show().removeAttr("disabled", "disabled");;
            }
        });

        $('input[name="check-frez"]').on('change',function(){
            if($('input[name="check-frez"]').is(":checked")){
                $('.ff > input').val('');
                $('.ff > input').attr("disabled", "disabled");
            }else{
                $('.ff > input').removeAttr("disabled", "disabled");
            }
        });

        $('#t').change(function () {
            var t = $('#t').val();
            if (t != 0) {
                $('.type-0').show();
                $('.type-'+t).show();
                $('.type-'+(3-t)).hide();
                if(t == 2){
                    $('#price-int').text('Цена за посещение *');
                }else{
                    $('#price-int').text('Цена *');
                }
            }
            else {
                $('.type-0').hide();
                $('.type-1').hide();
                $('.type-2').hide();
                $('#price-int').text('Cena');
            }
        });
        //$( function() {
        $('.digit').mask('999');
        $('#date').mask('99');
        $('#pr').mask('999999999');
        //} );
        var c = $('#branch_table').width();
        $('.me').css('width', Math.floor(c-990))
    </script>
@stop