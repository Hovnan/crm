@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Обновление посетителя</h3>
            </div>
                <form id="subscriber-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="name">
                                <label for="nom">Название *</label>
                                <input class="form-control1" type="text" name="name" id="nom" placeholder="Гимнастика" value="{{ $subscriber->name }}">
                                <span class="help-block"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="visits">
                                <div class="col-md-12" style="padding-left: 0;">
                                    <label for="vis">Количество посещений *</label>
                                </div>
                                <div class="col-md-4 dd" style="padding-left: 0;">
                                    <input class="form-control1 digit" type="text" name="visits" id="vis" value="{{ $subscriber->visits }}" {{ $subscriber->visits ? '' : 'disabled' }}>
                                </div>
                                <div class="checkbox-inline1 col-md-8">
                                    <label><input type="checkbox" name="check-date" {{ $subscriber->visits ? '' : 'checked' }}>Неограниченное</label>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="validity">
                                <div class="col-md-12" style="padding-left: 0;">
                                    <label for="date">Срок действия *</label>
                                </div>
                                <div class="col-xs-4 nn" style="padding-left: 0;">
                                    <input class="form-control1" type="text" name="validity" id="date" value="{{ $subscriber->validity }}" {{ $subscriber->validity ? '' : 'disabled' }}>
                                </div>
                                <div class="checkbox-inline1 col-md-8">
                                    <label><input type="checkbox" name="check" {{ $subscriber->validity ? '' : 'checked' }}>Неограниченное</label>
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group" id="price">
                                <div class="col-md-12" style="padding-left: 0;">
                                    <label for="pr">Цена *</label>
                                </div>
                                <div class="col-xs-4" style="padding-left: 0;">
                                    <input class="form-control1 " type="text" name="price" id="pr" value="{{ $subscriber->price }}">
                                </div>
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info pull-left btn-cust">Обновить</button>
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"> </div>
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

        $('#subscriber-form').submit(function(event){
            event.preventDefault();
            var postData = {
                "name": $('input[name=name]').val().toLowerCase(),
                "validity": $('input[name=check]').is(':checked')? 0 : $('input[name=check]').is(':checked')? 0 : $('input[name=validity]').val(),
                "visits": $('input[name=check-date]').is(':checked')? 0 : $('input[name=visits]').val(),
                "price": $('input[name=price]').val(),
                "old_name": "{{ strtolower($subscriber->name) }}"
            };
            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' span').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('subscriber.update', ['branch' => $branch->id, 'id' => $subscriber->id]) }}",
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
                //$('.nn > select').val('').prop('selected', true);
                $('.nn > input').attr("disabled", "disabled");
            }else{
                $('.nn > input').show().removeAttr("disabled", "disabled");
            }
        });
        //$( function() {
        //$( '#date' ).datepicker( $.datepicker.regional[ "ru" ] );
        $('.digit').mask('999');
        $('#pr').mask('999999999');
        /*$('#date').mask('AB/CD/EEGH', {'translation': {
            A: {pattern: /[0-3]/},
            B: {pattern: /[0-9]/},
            C: {pattern: /[0-1]/},
            D: {pattern: /[0-9]/},
            E: {pattern: /[19,20]/},
            //: {pattern: /[0,9]/},
            G: {pattern: /[0-9]/},
            H: {pattern: /[0-9]/}
        }*/
        //});
        $('#date').mask('99');
        //$('#co').mask('999999999');

    </script>
@stop