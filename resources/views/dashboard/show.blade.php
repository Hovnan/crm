@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1"></h3>
                <!--<div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="">
                            <button data-toggle="modal" data-target="#add_employee" type="button" class="btn btn-info btn-block" style="border-radius: 2px; background-color: #73a0ea; margin-left: 0 !important" >Добавить сотрудника</button>
                        </div>
                    </div>
                </div>-->
                <div class="panel-group" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1">
                                    Как добавить поситителей <img src="/imgs/arrow.png" alt="" /></a>
                            </h2>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">Необходимо создать систему работы с клиентами  для сети фитнес клубов. Система должна отслеживать весь путь работы с клиентом ,подача заявки(лиды),становления клиентом (покупка карты) и работа с клиентами которые уже пользуются услугами клубов(бронирование занятий и тд).Необходимо создать систему работы с клиентами  для сети фитнес клубов. Система должна отслеживать весь путь работы с клиентом ,подача заявки(лиды),становления клиентом (покупка карты) и работа с клиентами которые уже пользуются услугами клубов(бронирование занятий и тд).Необходимо создать систему работы с клиентами  для сети фитнес клубов.</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed">
                                    Collapsible Group 2 <img src="/imgs/arrow.png" alt="" /></a>
                            </h2>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2" class="collapsed">
                                    Collapsible Group 2 <img src="/imgs/arrow.png" alt="" /></a>
                            </h2>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
                                minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                                commodo consequat.</div>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="add_modal" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Добавить Филиала</h3>
                                <span class="f-type">Для дальнейших действий Вам необходимо создать филиал</span>
                            </div>
                        </div>
                    </div>
                </div>
                <!--branches.store-->
                <form action="{{ route('branches.store') }}" method="post">
                    {{ csrf_field() }}
                    <input type="hidden" name="company_id" value="{{ $company->id }}">
                    <div class="modal-body">
                        <div class="container-fluid">
                            <!-- Контейнер, в котором можно создавать классы системы сеток -->
                            <div class="row pad-b10">
                                <div class="col-xs-8">
                                    <p>Название Филиала*</p>
                                    <input type="text" class="form-control" id="email" name="name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">
                                    <p>Адрес*</p>
                                    <input type="text" class="form-control" name="address">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer x-type">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info pull-left btn-cust" >Добавить <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- / Modal -->
    <!-- Admin Modal -->
    <div class="modal fade" id="add_admin" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Админ</h3>
                                <!--<span class="f-type">Пригласите Админа для управления филиалом или станьте Админом сами</span>-->
                            </div>
                        </div>
                    </div>
                </div>
                <form action="{{ route('helper.store') }}" method="post">

                    <div class="modal-body">
                    {{ csrf_field() }}
                    <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row pad-b10">
                            <div class="col-xs-8">
                                <p>Админ Филиала*</p>
                                <input type="email" class="form-control" name="email">
                                <input type="hidden" name="branch_id" value="">
                            </div>
                        </div>
                        <div class="row pad-b10">
                            <div class="col-xs-8">
                                <p>Admin or manager*</p>
                                <select name="role" id="" class="form-control">
                                    <option value="admin">Admin</option>
                                    <option value="manager">Manager</option>
                                </select>
                            </div>
                        </div>
                        <div class="row pad-b10">
                            <div class="col-xs-8">
                                <input type="checkbox" name="permission[employee]" value="1">employee<br />
                                <input type="checkbox" name="permission[accounting]" value="1">accounting<br />
                                <input type="checkbox" name="permission[timetable]" value="1">timetable<br />
                                <input type="checkbox" name="permission[clases]" value="1">clases<br />
                                <input type="checkbox" name="permission[user]" value="1">user<br />
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
    </div>
    <!-- / Modal -->
@stop

@if(!$branch)
@section('scripts')
    <script type="text/javascript">
        $('document').ready(function(){
            $('#add_modal').modal("show");
        });

        function branchStore() {
            var postData = {
                "name": $('input[name=name]').val(),
                "address": $('input[name=address]').val(),
                "company_id": "{{ $company->id }}",
                "_token": $( "meta[name='csrf-token']" ).attr('content')
            };
            $.ajax({
                type: "POST",
                url: "{{ route('branches.store') }}",
                data: postData,
                success: function (id) {
                    $('document').ready(function(){
                        $('#add_modal').modal("hide");
                    });
                    $('document').ready(function(){
                        $('#add_admin').modal("show");
                    });
                    $('input[name=branch_id]').val(id);
                },
                error: function () {
                    console.log('error');
                }
            });
        }

    </script>
@stop
@endif