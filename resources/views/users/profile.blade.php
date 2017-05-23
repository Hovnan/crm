@extends('layouts.master')
@section('content')
        <div class="page_title">Профиль</div>
        <div class="space7"></div>

        <form class="form-inline search_form col-xs-12" action="{{ route('users.update', ['user' => $user->id]) }}" method="post">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
            <div class="form-group input-group col-xs-4">
                <label class="control-label" for="name">Имя*</label>
                <input type="text" class="form-control" id="name" name="first_name" value="{{ $user->first_name }}">
            </div>
            <div class="form-group input-group col-xs-4">
                <label class="control-label" for="surname">Фамилия*</label>
                <input type="text" class="form-control" id="surname" name="last_name" value="{{ $user->last_name }}">
            </div>
            <div class="clear"></div>
            <div class="space7"></div>
            <div class="form-group input-group col-xs-4">
                <label class="control-label" for="email">Почта*</label>
                <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="clear"></div>
            <div class="space7"></div>
            <div class="form-group input-group col-xs-3">
                <label class="control-label" for="old_pass">Старый пароль</label>
                <input type="text" class="form-control" id="old_pass" name="old_password">
            </div>
            <div class="form-group input-group col-xs-3">
                <label class="control-label" for="new_pass">Новый пароль</label>
                <input type="text" class="form-control" id="new_pass" name="password">
            </div>
            <div class="form-group input-group col-xs-3">
                <label class="control-label" for="confirm_pass">Подтвердите пароль</label>
                <input type="text" class="form-control" id="confirm_pass" name="password_confirmation">
            </div>
            <div class="clear"></div>
            <div class="space7"></div>
            <button type="submit" id="upd_profile" class="popup_button btn-primary">Сохранить</button>
        </form>
        <div class="clear"></div>
        <div class="space9"></div>
        <div class="page_title pull-left">Филиалы</div>
        <div id="add_branch" class="popup_button btn-primary pull-right" data-toggle="modal" data-target="#add_modal">Добавить филиал</div>
        <div class="clear"></div>
        <div class="space7"></div>
        <!-- Modal -->
        <div class="modal fade" id="add_modal" role="dialog" >
            <div class="modal-dialog modal-md">
                <div class="modal-content text-muted border-0">

                    <form action="{{ route('branches.store') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" value="{{ $company->id }}" name="company">
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
                                    <button type="submit" class="btn btn-info pull-left btn-cust">Добавить <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- / Modal -->
        <!-- Modal -->
        <div class="modal fade" id="add_admin" role="dialog" >
            <div class="modal-dialog modal-md">
                <div class="modal-content text-muted border-0">
                    <div class="modal-header z-type">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <div class="container-fluid">
                            <!-- Контейнер, в котором можно создавать классы системы сеток -->
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 class="modal-title">Филиал успешно 'Partners' добавлен</h3>
                                    <span class="f-type">Пригласите Админа для управления филиалом или станьте Админом сами</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <!-- Контейнер, в котором можно создавать классы системы сеток -->
                            <div class="row pad-b10">
                                <div class="col-xs-8">
                                    <p>Админ Филиала*</p>
                                    <input type="email" class="form-control" name="admin_email">
                                </div>
                            </div>
                            <p>Стать Админом самому *</p>
                            <div class="btn-group" data-toggle="buttons">
                                <label class="btn btn-default">
                                    <input type="checkbox" autocomplete="off"> <i class="fa fa-check" aria-hidden="true"></i>
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer x-type">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-8">
                                        <button type="button" class="btn btn-info pull-left btn-cust">Добавить <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Modal -->
        <div class="table-responsive page_table">
            <table id="branch_table" class="table table-bordered col-xs-12 text-center">
                <thead>
                <tr>
                    <th>&#8470;</th>
                    <th>Название</th>
                    <th>Адрес</th>
                    <th>Админы</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($company->branches as $branch)
                <tr>
                    <td>&#8470;</td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->address }}</td>
                    <td>@foreach($branch->users as $user)
                            <a>{{ $user->roles()->first()->slug }}</a>
                        @endforeach
                    </td>
                    <td><button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#edit_branch_{{ $branch->id }}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                    </td>
                </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        @foreach($company->branches as $branch)

            <!-- Modal -->
            <div class="modal fade" id="edit_branch_{{ $branch->id }}" role="dialog" >
                <div class="modal-dialog modal-md">
                    <div class="modal-content text-muted border-0">

                        <form action="{{ route('branches.update', ['branch' => $branch->id]) }}" method="post">
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
                                            <input type="text" class="form-control" id="email" name="name" value="{{ $branch->name }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-8">
                                            <p>Адрес*</p>
                                            <input type="text" class="form-control" name="address" value="{{ $branch->address }}">
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
            <!-- / Modal -->
            @endforeach
        <div class="clear"></div>
        <div class="space9"></div>
@stop