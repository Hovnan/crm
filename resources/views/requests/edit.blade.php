@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Обновление Заявки</h3>
            </div>
                <form id="request-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="name">
                                <label for="nom">ФИО *</label>
                                <input class="form-control1" type="text" name="name" id="nom" placeholder="ФИО" value="{{ $request->name }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="post">
                                <label for="po">Почта *</label>
                                <input class="form-control1" type="text" name="post" id="po"  value="{{ $request->post }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="phone">
                                <label for="gsm">Телефон *</label>
                                <input class="form-control1" type="text" name="phone" id="gsm"  value="{{ $request->phone }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="comment">
                                <label for="com">Комментарии</label>
                                <textarea class="form-control1 control11" rows="5" id="com" name="comment">{{ $request->comment }}</textarea>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-info pull-right btn-cust">Обновить</button>
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
                url:"{{ route('request.update', ['branch' => $branch->id, 'id' => $request->id]) }}",
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
        $('#gsm').mask('+7 (000) 000-00-00')
    </script>
@stop