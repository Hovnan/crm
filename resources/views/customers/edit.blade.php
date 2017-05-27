@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Профиль посетителя</h3>
                <h4 style="color: grey">Основная информация</h4>
            </div>
            <form id="customer-form">
                <div class="col-md-8" style="padding-left: 0">
                    <div class="row">
                        <div class="col-md-6 grid_box1">
                            <div class="form-group" id="name">
                                <label for="nom">ФИО *</label>
                                <input class="form-control1" type="text" name="name" id="nom" value="{{ $child->customer->name }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" id="child_name">
                                <label for="c-nom">ФИО ребенка *</label>
                                <input class="form-control1" type="text" name="child_name" id="c-nom" value="{{ $child->child_name }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid_box1">
                            <div class="form-group" id="phone">
                                <label for="gsm">Номер телефона</label>
                                <input class="form-control1" type="text" name="phone" id="gsm" value="{{ $child->customer->phone }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-3 grid_box1">
                            <div class="form-group" id="age">
                                <label for="date">Дата рождения *</label>
                                <div class="col-md-9" style="padding-left: 0;">
                                    <input class="form-control1" type="text" name="age" id="date" value="{{ $child->age->format('d.m.Y') }}">
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="col-xs-8" style="padding-left: 0;">
                                <div class="form-group" id="gender">
                                    <label for="gend">Пол ребенка</label>
                                    <div class="btn-group" data-toggle="buttons" id="gend">
                                        <label class="btn btn-default btn-my {{ $child->gender == 'male' ? 'active' : '' }}">
                                            <input type="radio" name="gender" id="option1" autocomplete="off" value="male" {{ $child->gender == 'male' ? 'checked' : '' }}> М
                                        </label>
                                        <label class="btn btn-default btn-my {{ $child->gender == 'female' ? 'active' : '' }}">
                                            <input type="radio" name="gender" id="option2" autocomplete="off" value="female" {{ $child->gender == 'female' ? 'checked' : '' }}> Ж
                                        </label>
                                    </div>
                                    <span class="help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid_box1">
                            <div class="form-group" id="post">
                                <label for="po">Почта *</label>
                                <input class="form-control1" type="text" name="post" id="po" value="{{ $child->customer->post }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2 col-md-offset-3">
                            <div class="form-group">
                                <label for="po">&nbsp;</label>
                                <button type="submit" class="btn btn-info btn-block btn-cust">Обновить</button>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
                <div class="col-md-4" style="padding-left: 0">
                    <div class="row">
                        <div class="col-md-12 grid_box1">
                            <div class="form-group">
                                <p>Соцсети</p>
                                <div class="btn-group" data-toggle="buttons" id="gend">
                                    @foreach($social as $k => $v)
                                        <label class="btn btn-default {{ array_key_exists($k, $child->customer->social)? 'active' : '' }}">
                                            <input class="rg" type="checkbox" name="soc[{{ $k }}]" id="{{ $k }}" autocomplete="off" {{  array_key_exists($k, $child->customer->social)? 'checked' : ''}}> {!! $v !!}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            @foreach($social as $k => $v)
                                <div class="form-group {{ $k }}" id="social" style="display: {{ array_key_exists($k, $child->customer->social)? 'block' : 'none' }}">
                                    <label class="control-label" for="soc">&nbsp;</label>
                                    <input class="form-control1 s-option{{ $k }}" type="text" name="option{{ $k }}" id="inp-{{ $k }}" placeholder="https://vk.com/ivan.ivanov" value="{{ array_key_exists($k, $child->customer->social)? $child->customer->social[$k] : '' }}">
                                    <span class="help-block"></span>
                                </div>
                            @endforeach
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                </div>
            </form>
            <div class="col-md-12" style="padding-left:0; margin-top:20px;">
                <h4 style="color: grey">Информация об абонементе</h4>
            </div>
            <table id="client_table" class="table table-bordered col-xs-12 text-center">
                <thead>

                <tr>
                    <th>N</th>
                    <th>Номер и тип абонимента</th>
                    <th>Кол-во ост. занятий</th>
                    <th>Дата окончания</th>
                    <th>Последнее посещение</th>
                    <th>Последнее посещение</th>
                    <th style="width: 120px;">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($child->visits as $visit)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ ucfirst($visit->subscriber->name) }}</td>
                    <!--<td>{{ $child->age->diffInYears() }}</td>-->
                        <td id="visits_{{ $visit->id }}">{{ $visit->remainder ? $visit->remainder : 'Неограниченное' }}</td>
                        <td id="valid_{{ $visit->id }}">{{ $visit->valid ? $visit->valid->format('d.m.Y') : 'Неограниченное' }}</td>
                        <td id="last_{{ $visit->id }}">{{ $child->visits->first()->last_visit ? $child->visits->first()->last_visit->format('d.m.Y') : 'Не посещал' }}</td>

                        <td item="{{ $visit->id }}">
                            {{ $visit->paid ? $visit->paid : 'Не оплачено' }}
                        </td>
                        <td item="{{ $visit->id }}">
                            <a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
                </div>
        </div>
@stop
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#customer-form').submit(function(event){
        //function actionSubmit(event){
            event.preventDefault();

            var r = $('input[type=checkbox]:checked');
            var arr = {};
            for(var i = 0; i<r.length; i++){
                var ke = r[i].id;
                arr[ke] = $('#inp-'+ke).val();
            }
            var postData = {
                "name": $('input[name=name]').val(),
                "phone": $('input[name=phone]').val(),
                "post": $('input[name=post]').val(),
                "social": arr,

                "child_name": $('input[name=child_name]').val(),
                "gender": $('input[name=gender]:checked').val(),
                "age": $('input[name=age]').val().split('/').reverse().join('-')
            };

            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' span').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('customer.update', ['branch' => $branch->id, 'id' => $child->id]) }}",
                data: postData,
                success: function(response){
                    window.location.href = response.redirect;
                },
                error: function(response){
                var result = response.responseJSON.errors;
                    for(var k in result) {
                        $('#'+k).addClass('has-error');
                        $('#'+ k +' span').text(result[k]);
                    }
                }
            });
        });
        function actionVisit(e){
            var button = $(e);

            var id = button.attr('data');
            var postData = {
                "id": id,
                "branch_id": "{{ $branch->id }}"
            };
            $.ajax({
                type: "POST",
                url: "{{ route('child.decrease') }}",
                data: postData,
                success: function (response) {
                    console.log(response.decrease['visits']);
                    $("#visits_"+id).text(response.decrease['visits']);
                    $("#valid_"+id).text(response.decrease['valid']);
                    if(response.decrease['visits'] == 0){
                        button.addClass('disabled');
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        };
        $('#sub').change(function (){
            var postData = {
                "branch_id": "{{ $branch->id }}",
                "id": $('#sub').val()
            };
            $.ajax({
                type: "POST",
                url: "{{ route('subscriber.price') }}",
                data: postData,
                success: function (response) {
                    console.log(response);

                    $('#fix-pr').text(response);
                },
                error: function () {
                    console.log('error');
                }
            });
        });
        $('.mySelect').change(function () {
            //alert(this.value+' '+this.name)
            var status = $('#status').val();
            var min = $('#min_year').val();
            var max = $('#max_year').val();
            var subscriber = $('#abonement').val();
            //alert(min);
            var postData = {
                "min": min,
                "max": max,
                "status": status,
                "subscriber": subscriber,
                "branch_id": "{{ $branch->id }}",
            };
             $.ajax({
                type: "POST",
                url: "{{ route('child.search') }}",
                data: postData,
                success: function (response) {
                    console.log(response);

                    $('#client_table tbody').html(response);
                },
                error: function () {
                    console.log('error');
                }
            });

        });
        $(".rg").change(function () {
            if(this.checked){
                $('.'+this.id).show()
            }else{
                $('.'+this.id).hide()
            }
            /*$('#show-check').hide();
            if($("#option2").is(":checked")){
                $('#show-check').show();
            }*/
            //$('#send').removeClass('disabled');

        });
            $('#gsm').mask('+7 (000) 000-00-00');
        $('#date').mask('AB/CD/EEGH', {'translation': {
            A: {pattern: /[0-3]/},
            B: {pattern: /[0-9]/},
            C: {pattern: /[0-1]/},
            D: {pattern: /[0-9]/},
            E: {pattern: /[19,20]/},
            //: {pattern: /[0,9]/},
            G: {pattern: /[0-9]/},
            H: {pattern: /[0-9]/}
        }
        });
        $('#t').on('change', function () {
            var t = $('#t').val();
            if (t != 0) {
                $('.fix').show();
                $('.fix-'+t).show();
                $('.fix-'+(3-t)).hide();
            }
            else {
                //$('.type-0').hide();
                $('.fix').hide();
                $('.fix-1').hide();
                $('.fix-2').hide();
            }
        });
        $('#vis').mask('999');
        //$('#co').mask('999999999');
        $('#vis').on('keyup', function () {
            /*
             $('#t').val('1').prop('selected', true);
             console.log($('#t').val());
             return false*/
            var postData = {
                "branch_id": "{{ $branch->id }}",
                "visit": $('input[name=visit]').val()
            };
            $.ajax({
                type: "POST",
                url: "{{ route('subscriber.unFixed') }}",
                data: postData,
                success: function (response) {
                    console.log(response);

                    $('#ins-pr').text(response);
                },
                error: function () {
                    console.log('error');
                }
            });
        });

        function addSubscrib () {

               // var r = $('input[type=checkbox]:checked');

                var postData = {
                    //"type": $('select[name=type]').val() ? '1',
                    "visit": $('select[name=type]').val() == '2' ? $('input[name=visit]').val() : null,
                    "paid": $('input[name=paid]').val() ? $('input[name=paid]').val() : '0',
                    "subscriber_id": $('select[name=type]').val() == '2' ? false : $('select[name=subscriber_id]').val(),
                };
/*
                for(var k in postData) {
                    $('#' + k).removeClass('has-error');
                    $('#' + k + ' span').text('');
                };
                */
                $.ajax({
                    type: 'POST',
                    url:"{{ route('customer.ajaxUpdate', ['branch_id' => $branch->id, 'id' => $child->id]) }}",
                    data: postData,
                    success: function(response){
                        //console.log(response);
                        window.location.href = response.redirect;
                    },
                    error: function(response){
                        /*var result = response.responseJSON.errors;
                        for(var k in result) {
                            $('#'+k).addClass('has-error');
                            $('#/'+ k +' span').text(result[k]);
                        }*/
                    }
                });
        }
        //$('#am').mask('999');
        //$('#co').mask('999999999');
    </script>
@stop