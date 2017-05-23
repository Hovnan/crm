@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Сотрудники</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="">
                            <button data-toggle="modal" data-target="#add_employee" type="button" class="btn btn-info btn-cust">Добавить сотрудника</button>
                        </div>
                    </div>
                </div>
                <form action="{{ route('employee.search', ['branch' => $branch->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label" for="">Поиск</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 grid_box1">
                                <input name="search" type="text" class="form-control1" placeholder=" (ФИО, Телефон)" value="{{ old('search') }}" autocomplete="off">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-info btn-cust">Найти</button>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 grid_box1">
                                <label class="control-label" for="s-desig">Должность</label>
                                <select class="form-control1 mySelect" id="s-desig" name="search_designation">
                                    <option value="">Все</option>
                                    @foreach($designation as $dKey => $dVal)
                                        <option value="{{ $dKey }}" {{ old('search_designation') == $dKey ? 'selected' : '' }}>{{ $dVal }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="control-label" for="s-sched">График работы</label>
                                <select class="form-control1 mySelect" id="s-sched" name="search_schedule">
                                    <option value="">Все</option>
                                    @foreach($schedule as $scKey => $scVal)
                                        <option value="{{ $scKey }}" {{ old('search_schedule') == $scKey ? 'selected' : '' }}>{{ $scVal }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="clearfix"> </div>
                </form>
            </div>
            <table id="client_table" class="table table-bordered col-xs-12 text-center">
                <thead>
                <tr>
                    <th>&#8470;</th>
                    <th>ФИО</th>
                    <th>Почта Номер Телефона</th>
                    <th>Должность</th>
                    <th>График работы</th>
                    <th>Отпуск Больничные</th>
                    <th>ЗП за январь</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->id }}</td>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->post.', '.$employee->phone }}</td>
                        <td>{{ $designation[$employee->designation] }}</td>
                        <td>{{ $schedule[$employee->schedule]}}</td>
                        <td>{{ $employee->holiday.', '.$employee->hospital }}</td>
                        <td>{{ $employee->salary }}</td>
                        <td>
                            <a href="{{ route('employee.edit', ['branch' => $branch->id, 'id' => $employee->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td><!--
                        <td>@foreach($employee->social as $s => $soc) {!! array_key_exists($s, $social)? '<a href="'.$soc.'" class="btn btn-default btn-xs">'.$social[$s].'</a>': '' !!}  @endforeach</td>-->
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="add_employee" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Добавить сотрудника</h3>
                                <!--<span class="f-type">Для добавления сотрудника Вам необходимо заполнить форму</span>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form id="employee-form">
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group" id="name">
                                        <label for="nom">ФИО *</label>
                                        <input class="form-control1" type="text" name="name" id="nom">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="dob">
                                        <label for="date">Дата рождения *</label>
                                        <input class="form-control1" type="text" name="dob" id="date" placeholder="ДД/ММ/ГГГГ">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group" id="phone">
                                        <label for="gsm">Номер телефона *</label>
                                        <input class="form-control1" type="text" name="phone" id="gsm">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="designation">
                                        <label for="design">Должность *</label>
                                        <select class="form-control1" name="designation" id="design">
                                            <option value="">Должность не выбран</option>
                                            @foreach($designation as $desKey => $desVal)
                                                <option value="{{ $desKey }}">{{ $desVal }}</option>
                                                @endforeach
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group" id="post">
                                        <label for="p">Почта *</label>
                                        <input type="text" class="form-control1" name="post" id="p">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="address">
                                        <label for="addr">Адрес *</label>
                                        <input type="text" class="form-control1" name="address" id="addr">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group" id="schedule">
                                        <label for="sch">График работы *</label>
                                        <select class="form-control1" name="schedule" id="sched">
                                            <option value="">График не выбран</option>
                                            @foreach($schedule as $schedKey => $schedVal)
                                            <option value="{{ $schedKey }}">{{ $schedVal }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="working">
                                        <label for="wor">Рабочие дни в нед. *</label>
                                        <input type="text" class="form-control1 digit" name="working" id="wor" onkeyup="setDigit()">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="salary">
                                        <label for="sal">ЗП за месяц *</label>
                                        <input type="text" class="form-control1" name="salary" id="sal" onkeyup="setSalary()">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group">
                                        <p>Соцсети *</p>
                                        <div class="btn-group" data-toggle="buttons" id="gend">
                                            @foreach($social as $k => $v)
                                                <label class="btn btn-default">
                                                    <input class="rch" type="checkbox" name="soc[{{ $k }}]" id="{{ $k }}" autocomplete="off" value=""> {!! $v !!}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 grid_box1">
                                    <div class="form-group" id="holiday">
                                        <label for="hol">Отпускные в год *</label>
                                        <input type="text" class="form-control1 digit" name="holiday" id="hol">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" id="hospital">
                                        <label for="hos">Больничные в год *</label>
                                        <input type="text" class="form-control1 digit" name="hospital" id="hos">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-md-offset-6">
                                    @foreach($social as $k => $v)
                                        <div class="form-group {{ $k }}" id="social" style="display: none">
                                            <label for="soc">&nbsp;</label>
                                            <input class="form-control1 s-option{{ $k }}" type="text" name="option{{ $k }}" id="inp-{{ $k }}" placeholder="https://vk.com/ivan.ivanov">
                                            <span class="help-block"></span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 pull-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block btn-cust">Добавить</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer x-type">
                    <div class="container-fluid">
                        <!-- <div class="row">
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
        <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#employee-form').submit(function(event){
            event.preventDefault();
            var r = $('input[type=checkbox]:checked');
            var arr = {};
            for(var i = 0; i<r.length; i++){
                var ke = r[i].id;
                arr[ke] = $('#inp-'+ke).val();
            }
            var postData = {
                "name": $('input[name=name]').val(),
                "dob": $('input[name=dob]').val().split('/').reverse().join('-'),
                "phone": $('input[name=phone]').val(),
                "designation": $('select[name=designation]').val(),
                //"email": $('input[name=email]').val(),
                "post": $('input[name=post]').val(),
                "address": $('input[name=address]').val(),
                "social": arr,
                "schedule": $('select[name=schedule]').val(),
                "working": $('input[name=working]').val(),
                "salary": $('input[name=salary]').val(),
                "holiday": $('input[name=holiday]').val(),
                "hospital": $('input[name=hospital]').val(),
                // "remember_me": $('input[name=remember_me]').is(':checked')
            };
            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' span').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('employee.store', ['branch' => $branch->id]) }}",
                data: postData,
                success: function(response){
                    //console.log('eeee');
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
        $('.mySelect').change(function () {
            var desig = $('#s-desig').val();
            var shced = $('#s-sched').val();
            var search = $('input[name=search]').val();
            var postData = {
                "search": search,
                "search_designation": desig,
                "search_schedule": shced,
                "branch_id": "{{ $branch->id }}",
            }

            $.ajax({
                type: "POST",
                url: "{{ route('employee.searchAjax') }}",
                data: postData,
                success: function (response) {
                    //console.log(response);

                    $('#client_table tbody').html(response);
                },
                error: function () {
                    console.log('error');
                }
            });

        })
        $(".rch").change(function () {
            if(this.checked){
                $('.'+this.id).show()
            }else{
                $('.'+this.id).hide()
            }

        })

//        function setDate(){
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

            $('#gsm').mask('+7 (000) 000-00-00');
            $('.digit').mask('999');
            $('#sal').mask('999999999');
    </script>
@stop