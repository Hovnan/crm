@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Заявки</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4" style="">
                            <button data-toggle="modal" data-target="#add_claim" type="button" class="btn btn-info btn-cust">Добавить заявку</button>
                        </div>
                    </div>
                </div>

                <form action="{{ route('request.search', ['branch' => $branch->id]) }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-4 grid_box1">
                                <label class="control-label" for="">Поиск</label>
                                <input name="search" type="text" class="form-control1" placeholder="ФИО, Телефон, Номер карты" value="{{ old('search') }}" autocomplete="off">
                            </div>
                            <div class="col-md-1">
                                <label class="control-label" for="">&nbsp;</label>
                                <button type="submit" class="btn btn-info btn-block btn-cust">Найти</button>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>
                    <hr />
                    <div class="clearfix"> </div>
                </form>
            </div>
            <table id="client_table" class="table table-bordered col-xs-10 text-center">
                <thead>
                <tr>
                    <th>&#8470;</th>
                    <th>ФИО</th>
                    <th>Телефон</th>
                    <th>Почта</th>
                    <th>Дата добавления</th>
                    <th>Комментарии</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($requests as $req)
                    <tr>
                        <td>{{ $req->id }}</td>
                        <td>{{ $req->name }}</td>
                        <td>{{ $req->phone }}</td>
                        <td>{{ $req->post }}</td>
                        <td>{{ $req->created_at->format('d.m.Y') }}</td>
                        <td>{{ $req->comment }}</td>
                        <td>
                            <a href="{{ route('request.edit', ['branch' => $branch->id, 'id' => $req->id]) }}" class="btn btn-info btn-xs"><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_claim" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="modal-title">Добавить заявку</h3>
                                <span class="f-type">Вам необходимо заполнить поля</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="request-form">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="name">
                                        <label for="nom">ФИО *</label>
                                        <input class="form-control1" type="text" name="name" id="nom" placeholder="ФИО">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="post">
                                        <label for="po">Почта *</label>
                                        <input class="form-control1" type="text" name="post" id="po">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group" id="phone">
                                        <label for="gsm">Телефон *</label>
                                        <input class="form-control1" type="text" name="phone" id="gsm">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" id="comment">
                                        <label for="com">Комментарии</label>
                                        <textarea class="form-control1 control11" rows="5" id="com" name="comment"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
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
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#request-form').submit(function(event){
            event.preventDefault();
            var postData = {
                "name": $('input[name=name]').val(),
                "post": $('input[name=post]').val(),
                "phone": $('input[name=phone]').val(),
                "comment": $('textarea[name=comment]').val()
            };
            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' span').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('request.store', ['branch' => $branch->id]) }}",
                data: postData,
                success: function(response){
                    window.location.href = response.redirect;
                },
                error: function(response){
                    var result = response.responseJSON.errors;

                    for(var k in result) {
                        //console.log(k, result[k]);
                        $('#'+k).addClass('has-error');
                        $('#'+ k +' span').text(result[k]);
                    }
                }
            });
        });
        $('#gsm').mask('+7 (000) 000-00-00');
    </script>
@stop