@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Профиль</h3>
                @if($record->role != 'manager')
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4" style="">
                                <button data-toggle="modal" data-target="#add_admin" type="button" class="btn btn-info btn-block" style="border-radius: 2px; background-color: #73a0ea; margin-left: 0 !important" >Добавить @if($record->role != 'admin') Admin or @endif Manager</button>
                            </div>
                        </div>
                    </div>
                @endif
                <form action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 grid_box1">
                                <label class="control-label" for="name">Имя*</label>
                                <input type="text" class="form-control1" id="name" name="first_name" value="{{ $user->first_name }}">
                            </div>
                            <div class="col-md-3 grid_box1">
                                <label class="control-label" for="surname">Фамилия*</label>
                                <input type="text" class="form-control1" id="surname" name="last_name" value="{{ $user->last_name }}">
                            </div>
                            <div class="col-md-3 grid_box1">
                                <label class="control-label" for="email">Почта*</label>
                                <input type="text" class="form-control1" id="email" name="email" value="{{ $user->email }}">
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 grid_box1">
                                <label class="control-label" for="new_pass">Новый пароль</label>
                                <input type="text" class="form-control1" id="new_pass" name="password">
                            </div>
                            <div class="col-md-3 grid_box1">
                                <label class="control-label" for="confirm_pass">Подтвердите пароль</label>
                                <input type="text" class="form-control1" id="confirm_pass" name="password_confirmation">
                            </div>
                            <div class="col-md-2 col-md-offset-4">
                                <label class="control-label" for="">&nbsp;</label>
                                <button type="submit" class="btn btn-info btn-block" style="border-radius: 2px; background-color: #73a0ea;" >Сохранить</button>
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
                    <th>&#8470;</th>
                    <th>ФИО</th>
                    <th>Должность</th>
                    <th>Доступы</th>
                </tr>
                </thead>
                <tbody>

                @foreach($branch->records as $recordik) <!--change $user in other name-->
                @if($recordik->user->id == $user->id)
                    @continue;
                @endif
                <tr>
                    <td>{{ $recordik->user->id }}</td>
                    <td>{{ $recordik->user->first_name .' '. $recordik->user->last_name }}</td>
                    <td>{{ $recordik->role  }}</td><!--must user->id change by branch->id-->
                    <td>
                        @foreach($access as $key => $value)

                            @if($recordik->role == 'manager')

                                <button class="btn btn-xs {{ !array_key_exists($key, $recordik->permissions)? 'btn-info': 'btn-default' }} {{ $key .'_'. $recordik->user->id }}" data-toggle="modal" data-target="#{{ $key .'_'. $recordik->user->id }}">{!! $value !!} </button>

                                <!-- Modal -->
                                <div class="modal fade" id="{{ $key .'_'. $recordik->user->id }}" role="dialog">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                <h4 class="modal-title">Modal Header</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>This is a small modal.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button id="{{ $recordik->user->id .'_'. $key }}" class="btn btn-primary {{ !array_key_exists($key, $recordik->permissions)? 'removePermission' : 'addPermission' }}" onclick="actionPermission(this)">Change</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <button class="btn btn-xs btn-info disabled">{!! $value !!} </button>
                            @endif

                        @endforeach
                    </td>
                </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <!--<div class="page_title pull-left">Название Филиалы</div>-->
    @if($record->role != 'manager')
        <!-- Modal -->
        <div class="modal fade" id="add_admin" role="dialog" >
            <div class="modal-dialog modal-md">
                <div class="modal-content text-muted border-0">
                    <div class="modal-header z-type">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="container-fluid">
                            <div id="message" class="alert alert-danger" style="display:none"></div>
                            <!-- Контейнер, в котором можно создавать классы системы сеток -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="modal-title">@if($record->role != 'admin') Админ or @endif Manager</h3>
                                    <!--<span class="f-type">Пригласите Админа для управления филиалом или станьте Админом сами</span>-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <!--id="helper-form"-->
                        <form  action="{{ route('invitation.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="container-fluid">
                                <!-- Контейнер, в котором можно создавать классы системы сеток -->
                                <!--<div class="row pad-b10">-->
                                <input type="hidden" name="branch_id" value="{{ $branch->id }}">
                                <div class="row">
                                    <div class="col-md-8" id="email-1">
                                        <div class="form-group" id="email">
                                            <label for="em">Почта*</label>
                                            <input type="email" class="form-control1" name="email" id="em">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row pad-b10">
                                    <div class="col-xs-8">
                                        <div class="btn-group" data-toggle="buttons">
                                            @if($record->role != 'admin')
                                                <label class="btn btn-default">
                                                    <input type="radio" name="role" id="option1" autocomplete="off" value="admin" class="rg"> Admin
                                                </label>
                                            @endif
                                            <label class="btn btn-default {{ $record->role == 'manager' ? 'active' : '' }}">
                                                <input type="radio" name="role" id="option2" autocomplete="off" value="manager" class="rg" {{ $record->role == 'admin' ? 'checked' : '' }}> Manager
                                            </label>
                                        </div>
                                    <!--
                                    <p></p>
                                    <select name="role" id="" class="form-control">
                                        <option value="0">Select @if($record->role != 'admin') Админ or @endif Manager</option>
                                        @if($record->role != 'admin')
                                        <option value="admin">Admin</option>
                                    @endif
                                            <option value="manager">Manager</option>
                                        </select>-->
                                    </div>
                                </div>
                                <!--
                                                            <p>Абонементы</p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-primary">
                                                                    <input type="checkbox" autocomplete="off" name="permission[abonements]" value="0"><i class="fa fa-check" aria-hidden="true"></i>
                                                                </label>
                                                                </div>

                                                            <p>Расписание</p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-primary">
                                                                    <input type="checkbox" autocomplete="off" name="permission[bookkeeping]" value="0"><i class="fa fa-check" aria-hidden="true"></i>
                                                                </label>
                                                            </div>

                                                            <p>Сотрудники</p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-default btn-xs">
                                                                    <input type="checkbox" autocomplete="off" name="permission[employees]" value="0"><i class="fa fa-check" aria-hidden="true"></i>
                                                                </label>
                                                                </div>

                                                            <p>Занятия</p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-primary">
                                                                    <input type="checkbox" autocomplete="off" name="permission[lessons]" value="0"><i class="fa fa-check" aria-hidden="true"></i>
                                                                </label>
                                                                </div>
                                                            <p>Request</p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-primary">
                                                                    <input type="checkbox" autocomplete="off" name="permission[request]" value="0"><i class="fa fa-check" aria-hidden="true"></i>
                                                                </label>
                                                                </div>
                                                            <p>Бухгалтерия</p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-primary">
                                                                    <input type="checkbox" autocomplete="off" name="permission[schedule]" value="0"><i class="fa fa-check" aria-hidden="true"></i>
                                                                </label>
                                                                </div>
                                                            <p>Посетители</p>
                                                            <div class="btn-group" data-toggle="buttons">
                                                                <label class="btn btn-primary">
                                                                    <input type="checkbox" autocomplete="off" name="permission[visitors]" value="0"><i class="fa fa-check" aria-hidden="true"></i>
                                                                </label>
                                                            </div>-->
                                <div class="row pad-b10" style="display:{{ $record->role == 'manager' ? 'block' : 'none' }}" id="show-check">

                                    <div class="col-xs-8">
                                        <p>Ограничение доступов менеджера к функциям системы</p>
                                        <input type="checkbox" name="permission[abonements]" value="0">Абонементы<br />
                                        <input type="checkbox" name="permission[bookkeeping]" value="0">Расписание<br />
                                        <input type="checkbox" name="permission[employees]" value="0">Сотрудники<br />
                                        <input type="checkbox" name="permission[lessons]" value="0">Занятия<br />
                                        <input type="checkbox" name="permission[request]" value="0">Request<br />
                                        <input type="checkbox" name="permission[schedule]" value="0">Бухгалтерия<br />
                                        <input type="checkbox" name="permission[visitors]" value="0">Посетители<br />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer x-type">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="form-group">
                                            <button id="send" type="submit" class="btn btn-info pull-left btn-cust disabled">Добавить <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <!-- / Modal -->

<!--????????->
    @foreach($company->branches as $branchik)

        <!-- Modal -->
        <div class="modal fade" id="edit_branch_{{ $branchik->id }}" role="dialog" >
            <div class="modal-dialog modal-md">
                <div class="modal-content text-muted border-0">

                    <form action="{{ route('branches.update', ['branch' => $branchik->id]) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="modal-header z-type">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <div class="container-fluid">
                                <!-- Контейнер, в котором можно создавать классы системы сеток -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <h3 class="modal-title">Edit Филиала</h3>
                                        <span class="f-type">Для дальнейших действий Вам необходимо edit филиал</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="container-fluid">
                                <!-- Контейнер, в котором можно создавать классы системы сеток -->
                                <div class="row pad-b10">
                                    <div class="col-xs-8">
                                        <p>Название Филиала*</p>
                                        <input type="text" class="form-control" id="email" name="name" value="{{ $branchik->name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-8">
                                        <p>Адрес*</p>
                                        <input type="text" class="form-control" name="address" value="{{ $branchik->address }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer x-type">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
                                        <button type="submit" class="btn btn-info pull-left btn-cust">Добавить <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <!--????????-->
@stop
@section('scripts')
    <script type="text/javascript">
        function actionPermission(e){
            var button = $(e);
            var clickId = button.attr('id');
            var myArray = clickId.split('_');
            var postData = {
                "id": myArray[0],
                "permission": myArray[1],
                "branch_id": "{{ $branch->id }}",
                "_token": $( "meta[name='csrf-token']" ).attr('content')
            }
            if(button.hasClass('addPermission')){
                $.ajax({
                    type: "POST",
                    url: "{{ route('permission.store') }}",
                    data: postData,
                    success: function (e) {
                        console.log(e);
                        $("#"+myArray[1]+"_"+myArray[0]).modal("hide");
                        button.removeClass("addPermission").addClass("removePermission");
                        $("."+myArray[1]+"_"+myArray[0]).removeClass("btn-default").addClass("btn-info");
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            }
            //button.hasClass('removePermission');
            if(button.hasClass('removePermission')){
                $.ajax({
                    type: "POST",
                    url: "{{ route('permission.remove') }}",
                    data: postData,
                    success: function (e) {
                        console.log(e);
                        $("#"+myArray[1]+"_"+myArray[0]).modal("hide");
                        button.removeClass("removePermission").addClass("addPermission");
                        $("."+myArray[1]+"_"+myArray[0]).removeClass("btn-info").addClass("btn-default");
                    },
                    error: function () {
                        console.log('error');
                    }
                });
            }
        };

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#helper-form').submit(function(event){

            event.preventDefault();
            $('#email-helper').text('').hide();
            $('#email-1').removeClass('has-error');

            var postData = {
                "email": $('input[name=mail]').val(),
                "_token": $( "meta[name='csrf-token']" ).attr('content')
                //"password": $('input[name=password]').val(),
                //"remember_me": $('input[name=remember_me]').is(':checked')
            };
            $.ajax({
                type: 'POST',
                url: "{{ route('invitation.store') }}",
                data: postData,
                success: function(response){
                    window.location.href = response.redirect;
                },
                error: function(response){

                    $('#email-helper').text(response.responseJSON.email).show();
                    $('#email-1').addClass('has-error');
                }
            });
        });
        $(".rg").change(function () {
            $('#show-check').hide();
            if($("#option2").is(":checked")){
                $('#show-check').show();
            }
            $('#send').removeClass('disabled');

        })

    </script>
@stop