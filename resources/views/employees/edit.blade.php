@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Обновление Сотрудника</h3>
            </div>
                <form id="employee-form">
                    <div class="row">
                        <div class="col-md-4 grid_box1">
                            <div class="form-group" id="name">
                                <label for="nom">ФИО *</label>
                                <input class="form-control1" type="text" name="name" id="nom" value="{{ $employee->name }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="dob">
                                <label for="date">Дата рождения *</label>
                                <input class="form-control1" type="text" name="dob" id="date" placeholder="ДД/ММ/ГГГГ" value="{{ $employee->dob->format('d.m.Y') }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 grid_box1">
                            <div class="form-group" id="phone">
                                <label for="gsm">Номер телефона *</label>
                                <input class="form-control1" type="text" name="phone" id="gsm" value="{{ $employee->phone }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="designation">
                                <label for="design">Должность *</label>
                                <select class="form-control1" name="designation" id="design">
                                    <option value="">Должность не выбран</option>
                                    <option value="">График не выбран</option>
                                    @foreach($designation as $dKey => $dVal)
                                        <option value="{{ $dKey }}" {{ $dKey == $employee->designation ? 'selected' : '' }}>{{ $dVal }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 grid_box1">
                            <div class="form-group" id="post">
                                <label for="p">Почта *</label>
                                <input type="text" class="form-control1" name="post" id="p" value="{{ $employee->post }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" id="address">
                                <label for="addr">Адрес *</label>
                                <input type="text" class="form-control1" name="address" id="addr" value="{{ $employee->address }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 grid_box1">
                            <div class="form-group" id="schedule">
                                <label for="sch">График работы *</label>
                                <select class="form-control1" name="schedule" id="sched">
                                    <option value="">График не выбран</option>
                                    @foreach($schedule as $sKey => $sVal)
                                        <option value="{{ $sKey }}" {{ $sKey == $employee->schedule ? 'selected' : '' }}>{{ $sVal }}</option>
                                    @endforeach
                                </select>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" id="working">
                                <label for="wor">Рабочие дни в нед. *</label>
                                <input type="text" class="form-control1 digit" name="working" id="wor" value="{{ $employee->working }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" id="salary">
                                <label for="sal">ЗП за месяц *</label>
                                <input type="text" class="form-control1" name="salary" id="sal" value="{{ $employee->salary }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 grid_box1">
                            <div class="form-group">
                                <p>Соцсети *</p>
                                <div class="btn-group" data-toggle="buttons" id="gend">
                                    @foreach($social as $k => $v)
                                        <label class="btn btn-default {{ array_key_exists($k, $employee->social)? 'active' : '' }}">
                                            <input class="rch" type="checkbox" name="soc[{{ $k }}]" id="{{ $k }}" autocomplete="off" {{  array_key_exists($k, $employee->social)? 'checked' : ''}} > {!! $v !!}
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 grid_box1">
                            <div class="form-group" id="holiday">
                                <label for="hol">Отпускные в год *</label>
                                <input type="text" class="form-control1 digit" name="holiday" id="hol" value="{{ $employee->holiday }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group" id="hospital">
                                <label for="hos">Больничные в год *</label>
                                <input type="text" class="form-control1 digit" name="hospital" id="hos" value="{{ $employee->hospital }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                                @foreach($social as $k => $v)
                                    <div class="form-group {{ $k }}" id="social" style="display: {{ array_key_exists($k, $employee->social)? 'block' : 'none' }}">
                                        <label class="control-label" for="soc">&nbsp;</label>
                                        <input class="form-control1 s-option{{ $k }}" type="text" name="option{{ $k }}" id="inp-{{ $k }}" placeholder="https://vk.com/ivan.ivanov" value="{{ array_key_exists($k, $employee->social)? $employee->social[$k] : '' }}">
                                        <span class="help-block"></span>
                                    </div>
                                @endforeach
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-md-offset-4">
                            <div class="form-group ">
                                <button type="submit" class="btn btn-info btn-cust ">Обновить</button>
                            </div>
                        </div>
                    </div>
                </form>
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
                url:"{{ route('employee.update', ['branch' => $branch->id, 'id' => $employee->id]) }}",
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