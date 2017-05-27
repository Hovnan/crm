@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Посетители</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-2">
                            <button data-toggle="modal" data-target="#add_visitors" class="btn btn-info btn-cust">Добавить посетителя</button>
                        </div>
                    </div>
                </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 grid_box1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="control-label" for="">Поиск (ФИО, Телефон, Номер карты)</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <input name="search" type="text" class="form-control1" placeholder="" value="{{ old('search') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-info btn-cust" onclick="mySearch()">Найти</button>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"> </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3 grid_box1">
                                <label class="control-label" for="status">Статус</label>
                                <select name="status" id="status" class="form-control1 mySelect">
                                    <option value="">Все</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : ''}}>Активный</option>
                                    <option value="2" {{ old('status') == 2 ? 'selected' : ''}}>Неактивный</option>
                                </select>
                            </div>
                            <div class="col-md-2 col-md-offset-1 grid_box1">
                                <div class="row">
                                    <label class="control-label" for="min_year">Возраст ребенка</label>
                                </div>
                                <div class="row">
                                    <div class="col-md-6" style="padding-left: 0;">
                                        <select class="form-control1 mySelect" id="min_year" name="min">
                                            <option value="0">От</option>
                                            @for($i=1; $i<16; $i++)
                                                <option value="{{ $i }}" {{ old('min') == $i ? 'selected' : ''}}>{{ $i }}</option>
                                                @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-6" style="padding-left: 0;">
                                        <select class="form-control1 mySelect" id="max_year" name="max">
                                            <option value="16">До</option>
                                            @for($i=15; $i>0; $i--)
                                                <option value="{{ $i }}" {{ old('max') == $i ? 'selected' : ''}}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-md-offset-1">
                                <label class="control-label" for="abonement">Абонемент</label>
                                <select class="form-control1 mySelect" id="abonement" name="subscriber">
                                    <option value="">Все</option>
                                    @foreach($subscribers as $subscriber)
                                        <option value="{{ $subscriber->id }}" {{ old('subscriber') == $subscriber->id ? 'selected' : ''}}>{{ $subscriber->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="clearfix"> </div>
            </div>
            <table id="client_table" class="table table-bordered col-xs-12 text-center">
                <thead>
                <tr>
                    <th>N</th>
                    <th>ФИО</th>
                    <th>Телефон, Почта</th>
                    <th>Номер и тип абонимента</th>
                    <th>Кол-во ост. занятий</th>
                    <th>Дата окончания</th>
                    <th>Последнее посещение</th>
                    <th style="width: 120px;">Действия</th>
                </tr>
                </thead>
                <tbody>
                @foreach($childs as $child)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><a href="{{ route('customer.edit', ['branch' => $branch->id, 'id' => $child->id]) }}">{{ $child->child_name }}</a><br><span style="font-size: 10px" class="pull-right">{{  $child->customer->name }}</span></td>
                        <td>{{ $child->customer->phone}}<br>{{$child->customer->post }}</td>
                        <td>
                        @foreach($child->subscribers as $childSub)
                            {{ ucfirst($childSub->name) }}<br>
                        @endforeach
                        </td>
                        <!--<td>{{ $child->age->diffInYears() }}</td>-->
                        <td>
                        @foreach($child->visits as $child1)
                                <span id="visits_{{ $child1->id }}">{{ $child1->remainder != null ? $child1->remainder : 'Неограниченное' }}</span><br>
                        @endforeach
                            </td>
                        <td>
                        @foreach($child->visits as $child2)
                                <span>{{ $child2->valid ? $child2->valid->format('d.m.Y') : 'Неограниченное' }}</span><br>
                        @endforeach
                        </td>
                        <td>
                        @foreach($child->visits as $child3)
                                <span id="last_{{ $child3->id }}">{{ $child3->last_visit ? $child3->last_visit->format('d.m.Y') : 'Не посещал' }}</span><br>
                        @endforeach
                        </td>
                        <td item="{{ $child->id }}">
                                 <!--<a href="javascript:void(0)"></a>
                            <button data="{{ $child->id }}" class="btn btn-info btn-xs"  onclick="actionVisit(this)"><i class="fa fa-scissors" aria-hidden="true"></i></button>&nbsp;-->
                            <button class="btn btn-info btn-xs"  onclick="actionVisitModal(this)"><i class="fa fa-scissors" aria-hidden="true"></i></button>&nbsp;

                                <button class="btn btn-default btn-xs" onclick="actionShow(this)"><i class="fa fa-plus" aria-hidden="true"></i></button>&nbsp;<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="add_visitors" role="dialog" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Добавить посетителя</h3>
                                <!--<h3 class="blank1">Добавить посетителя</h3>-->
                                <span class="f-type">Для добавления посетителя Вам необходимо заполнить форму</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form id="customer-form">
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group" id="name">
                                        <label for="nom">ФИО *</label>
                                        <input class="form-control1" type="text" name="name" id="nom">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group" id="child_name">
                                        <label for="c-nom">ФИО ребенка *</label>
                                        <input class="form-control1" type="text" name="child_name" id="c-nom">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group" id="phone">
                                        <label for="gsm">Номер телефона</label>
                                        <input class="form-control1" type="text" name="phone" id="gsm">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3 grid_box1">
                                    <div class="form-group" id="age">
                                        <label for="date">Дата рождения *</label>
                                        <div class="col-md-8" style="padding-left: 0;">
                                        <input class="form-control1" type="text" name="age" id="date">
                                            </div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="col-xs-8" style="padding-left: 0;">
                                    <div class="form-group" id="gender">
                                        <label for="gend">Пол ребенка</label>
                                        <div class="btn-group" data-toggle="buttons" id="gend">
                                            <label class="btn btn-default btn-my">
                                                <input type="radio" name="gender" id="option1" autocomplete="off" value="male"> М
                                            </label>
                                            <label class="btn btn-default btn-my">
                                                <input type="radio" name="gender" id="option2" autocomplete="off" value="female"> Ж
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
                                        <input class="form-control1" type="text" name="post" id="po">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                              </div>
                            <div class="row">
                                <div class="col-md-6 grid_box1">
                                    <div class="form-group">
                                        <p>Соцсети *</p>
                                        <div class="btn-group" data-toggle="buttons" id="gend">
                                            @foreach($social as $k => $v)
                                                <label class="btn btn-default">
                                                    <input class="rg" type="checkbox" name="soc[{{ $k }}]" id="{{ $k }}" autocomplete="off"> {!! $v !!}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @foreach($social as $k => $v)
                                        <div class="form-group {{ $k }}" id="social" style="display: none">
                                            <label class="control-label" for="soc">&nbsp;</label>
                                            <input class="form-control1 s-option{{ $k }}" type="text" name="option{{ $k }}" id="inp-{{ $k }}" placeholder="https://vk.com/ivan.ivanov">
                                            <span class="help-block"></span>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row" id="insert-submit">
                                <div class="col-md-3 pull-right">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block btn-cust">Добавить</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="update-button" style="display: none">
                                <div class="col-md-3 pull-right">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-info btn-block btn-cust" onclick="alert(777)">Edit</button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <span class="f-type">Добавления абонемента</span>
                                </div>
                                 </div>
                            <div class="row">
                                <div class="col-md-3 grid_box1">
                                    <div class="form-group" id="type">
                                        <label for="t">Вид абонента *</label>
                                        <select class="form-control1" id="t" name="type">
                                            <option value="0">Не выбран</option>
                                            <option value="1">Фиксировании</option>
                                            <option value="2">Не фиксировании</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3 fixed-1" style="display: none">
                                    <div class="form-group" id="subscriber_id">
                                        <label for="sub">Название абонента *</label>
                                        <select class="form-control1" id="sub" name="subscriber_id">
                                            <option value="">Не выбран</option>
                                            @foreach($subscribers as $subscriber)
                                                @if($subscriber->type)
                                                    @continue
                                                @endif
                                                <option value="{{ $subscriber->id }}">{{ $subscriber->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3 fixed-2" style="display: none">
                                    <div class="form-group" id="visit">
                                        <label for="vis">Количество посещений *</label>
                                        <div class="col-md-5" style="padding-left: 0">
                                            <input type="text" class="form-control1 vis" name="visit" id="vis" data>
                                        </div>
                                        <div class="col-md-7"><p id="ins-pr" style="padding-top: 5px"></p></div>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="col-md-3 fixed-0 grid_box1" style="display: none">
                                    <div class="form-group" id="paid">
                                        <label for="pay">Оплаченная сумма * &nbsp;</label>
                                        <div class="col-md-6" style="padding-left: 0">
                                            <input type="text" class="form-control1" name="paid" id="pay">
                                        </div>
                                        <div class="col-md-6"><p id="fixed-pr" style="padding-top: 5px"></p></div>
                                        <span class="help-block"></span>
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

    <!-- Modal For subscribers-->
    <div class="modal fade" id="add_subscriber" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Добавить абонемент</h3>
                                <!--<h3 class="blank1">Добавить посетителя</h3>
                                <span class="f-type">Для добавления посетителя Вам необходимо заполнить форму</span>
                            --></div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8 grid_box1">
                                    <div class="form-group" id="type1">
                                        <label for="t1">Вид абонемента *</label>
                                        <select class="form-control1" id="t1" name="type1">
                                            <option value="0">Не выбран</option>
                                            <option value="1">Фиксировании</option>
                                            <option value="2">Не фиксировании</option>
                                        </select>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                                </div>
                            <div class="row">
                                <div class="col-md-8 fix-1 grid_box1" style="display: none">
                                    <div class="form-group" id="sub_id">
                                        <label for="sub1">Название абонемента *</label>
                                        <select class="form-control1" id="sub1" name="sub_id">
                                            <option value="">Не выбран</option>
                                            @foreach($subscribers as $subscriber)
                                        @if($subscriber->type)
                                            @continue
                                        @endif
                                                <option value="{{ $subscriber->id }}">{{ $subscriber->name }}</option>
                                            @endforeach
                                            </select>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                <div class="clearfix"> </div>
                                    </div>
                            <div class="row">
                                    <div class="col-md-6 fix-2 grid_box1" style="display: none">
                                        <div class="form-group" id="visit1">
                                            <label for="vis">Количество посещений *</label>
                                            <div class="col-md-6" style="padding-left: 0">
                                                <input type="text" class="form-control1" name="visit1" id="vis1">
                                            </div>
                                            <div class="col-md-6"><p id="ins-pr1" style="padding-top: 5px"></p></div>
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                <div class="clearfix"> </div>
                            </div>
                            <div class="row">
                                    <div class="col-md-6 fix grid_box1" style="display: none">
                                        <div class="form-group" id="paid1">
                                            <label for="pay1">Оплаченная сумма * &nbsp;</label>
                                        <div class="col-md-6" style="padding-left: 0">
                                            <input type="text" class="form-control1" name="paid1" id="pay1">
                                        </div>
                                        <div class="col-md-6"><p id="fix-pr1" style="padding-top: 5px"></p></div>
                                        <span class="help-block"></span>
                                    </div>
                                    </div>
                                <div class="clearfix"> </div>
                                    </div>
                            <div class="row">
                                <input type="hidden" name="child_id">
                                <div class="col-md-6 fix grid_box1" style="display: none; margin-top: 24px">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-info btn-cust" onclick="addSubscrib()">Добавить</button>
                                    </div>
                                </div>
                                <div class="clearfix"> </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer x-type">
                    <div class="container-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.Modal For subscribers-->

    <!-- Modal For visits-->
    <div class="modal fade" id="visit_modal" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Выбирайте абонемент</h3>
                                <!--<h3 class="blank1">Добавить посетителя</h3>
                                <span class="f-type">Для добавления посетителя Вам необходимо заполнить форму</span>
                            --></div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <span id="mumu"> </span>
                    </div>
                </div>
                <div class="modal-footer x-type">
                    <div class="container-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/.Modal For visits-->
@stop
@section('scripts')
    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN" : $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#customer-form').submit(function(event){
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

                "paid": $('input[name=paid]').val() ? $('input[name=paid]').val() : '0',
                "child_name": $('input[name=child_name]').val(),
                "gender": $('input[name=gender]:checked').val(),
                "age": $('input[name=age]').val().split('/').reverse().join('-'),
                "subscriber_id": $('select[name=type]').val() == '2' ? null :$('select[name=subscriber_id]').val(),
                "visit": $('select[name=type]').val() == '2' ? $('input[name=visit]').val() : null,
            };

            for(var k in postData) {
                $('#' + k).removeClass('has-error');
                $('#' + k + ' span').text('');
            };
            $.ajax({
                type: 'POST',
                url:"{{ route('customer.store', ['branch' => $branch->id]) }}",
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
        /*
        function addSubscriber(e) {
            var button = $(e);
            var id = button.attr('item');

            var postData = {
                "id": id,
                "branch_id": "{{ $branch->id }}"
            }
            $.ajax({
                type: "POST",
                url: "{{ route('child.attach') }}",
                data: postData,
                success: function (response) {
                    //console.log(response.decrease['remainder']);
                    $("#visits_"+id).text(response.decrease['remainder']);
                    $("#last_"+id).text(response.decrease['last_visit']);
                    if(response.decrease['remainder'] == 0){
                        button.addClass('disabled');
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }*/
        $('#add_subscriber').on('hidden.bs.modal', function () {
            $('#ins-pr1').text('');
            $('#fix-pr1').text('');
            $('#vis1').val('');
            $('#pay1').val('');
            $('#t1 option').removeAttr('selected');
            $('#sub1 option').removeAttr('selected');
        })
        function actionVisit(e){

            //e.preventDefault();
            var button = $(e);
            var id = button.attr('data').split('-');

            var postData = {
                "id": id[0],
                "visit_id": id[1],
                "branch_id": "{{ $branch->id }}"
            }
            $.ajax({
                type: "POST",
                url: "{{ route('child.decrease') }}",
                data: postData,
                success: function (response) {
                    $("#visit_modal").modal('hide');
                    $("#visits_"+id[1]).text(response.decrease['remainder']);
                    $("#last_"+id[1]).text(response.decrease['last_visit']);
                    /*if(response.decrease['remainder'] == 0){
                        button.addClass('disabled');
                    }*/
                },
                error: function () {
                    console.log('error');
                }
            });
        }
        function mySearch(){
            var search = $('input[name=search]').val();
            var status = $('#status').val();
            var min = $('#min_year').val();
            var max = $('#max_year').val();
            var subscriber = $('#abonement').val();
            //alert(min);
            var postData = {
                "min": min,
                "max": max,
                "status": status,
                "search": search,
                "subscriber": subscriber,
                "branch_id": "{{ $branch->id }}",
            }

            $.ajax({
                type: "POST",
                url: "{{ route('child.search') }}",
                data: postData,
                success: function (response) {
                    //console.log(response);
                    //return false;

                    $('#client_table tbody').html(response);
                },
                error: function () {
                    console.log('error');
                }
            });
        }
        $('.mySelect').change(function () {
            mySearch();
        })

        $(".rg").change(function () {
            if(this.checked){
                $('.'+this.id).show();
            }else{
                $('.'+this.id).hide();
            }
            /*$('#show-check').hide();
            if($("#option2").is(":checked")){
                $('#show-check').show();
            }*/
            //$('#send').removeClass('disabled');

        });
        $('#gsm').mask('+7 (000) 000-00-00')
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
        $('#vis').mask('999');
        //$('#co').mask('999999999');
        $('#vis').on('keyup', function () {
/*
            $('#t').val('1').prop('selected', true);
            console.log($('#t').val());
            return false*/
            $('.fixed-0').show();
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
        $('#vis1').mask('999');
        //$('#co').mask('999999999');
        $('#vis1').on('keyup', function () {
            /*
             $('#t').val('1').prop('selected', true);
             console.log($('#t').val());
             return false*/
            var postData = {
                "branch_id": "{{ $branch->id }}",
                "visit": $('input[name=visit1]').val()
            };
            $.ajax({
                type: "POST",
                url: "{{ route('subscriber.unFixed') }}",
                data: postData,
                success: function (response) {
                    console.log(response);

                    $('#ins-pr1').text(response);
                },
                error: function () {
                    console.log('error');
                }
            });
        });

        $('#t1').on('change', function () {
            var t = $('#t1').val();

            $('#ins-pr1').text('');
            $('#fix-pr1').text('');
            $('#vis1').val('');
            $('#pay1').val('');
            $('#sub1 option').removeAttr('selected');

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
        $('#sub1').change(function (){
            var postData = {
                "branch_id": "{{ $branch->id }}",
                "id": $('#sub1').val()
            };
            $.ajax({
                type: "POST",
                url: "{{ route('subscriber.price') }}",
                data: postData,
                success: function (response) {
                    //console.log(response);

                    $('#fix-pr1').text(response);
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
                "visit": $('select[name=type1]').val() == '2' ? $('input[name=visit1]').val() : null,
                "paid": $('input[name=paid1]').val() ? $('input[name=paid1]').val() : '0',
                "sub_id": $('select[name=type1]').val() == '2' ? false : $('select[name=sub_id]').val(),
                "id": $('input[name=child_id]').val()
            }
            /*
             for(var k in postData) {
             $('#' + k).removeClass('has-error');
             $('#' + k + ' span').text('');
             };
             */
            $.ajax({
                type: 'POST',
                url:"{{ route('customer.ajaxUpdate', ['branch_id' => $branch->id]) }}",
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
        $('#t').on('change', function () {
           var t = $('#t').val();
            $('.fixed-0').hide();

            $('#ins-pr').text('');
            $('#fixed-pr').text('');
            $('#vis').val('');
            $('#pay').val('');
            $('#sub option').removeAttr('selected');

            if (t != 0) {
                $('.fixed-'+t).show();
                $('.fixed-'+(3-t)).hide();

            }
            else {
                //$('.type-0').hide();
                $('.fixed-1').hide();
                $('.fixed-2').hide();
            }
        });
        $('#sub').change(function (){

            $('.fixed-0').show();
            var postData = {
                "branch_id": "{{ $branch->id }}",
                "id": $('#sub').val()
            };
            $.ajax({
                type: "POST",
                url: "{{ route('subscriber.price') }}",
                data: postData,
                success: function (response) {
                    //console.log(response);

                    $('#fixed-pr').text(response);
                },
                error: function () {
                    console.log('error');
                }
            });
        });
        function actionShow(e){
            var id = $(e).parent().attr('item');
            $("#add_subscriber").modal('show');
            $('input[name=child_id]').val(id);
        }
        function actionVisitModal(e){
            var id = $(e).parent().attr('item');
            //console.log(id);
            $("#visit_modal").modal('show');
            //$("#mumu").text(id);
            //$('input[name=child_id]').val(id);
            var postData = {
                "id": id,
                "branch_id": "{{ $branch->id }}"
            }
            $.ajax({
                type: "POST",
                url: "{{ route('child.edit') }}",
                data: postData,
                success: function (response) {
                    $("#mumu").html(response);
                    //console.log(response.decrease['remainder']);
                    //$('input[name=name]').val(response.customer['name']);
                    //$('input[name=phone]').val(response.customer['phone']);
                    //$('input[name=post]').val(response.customer['post']);
                    //"social": arr,
                    //$('input[name=child_name]').val(response.child['child_name']),
                           /* $('input[name=gender][value='+gen+']').prop('checked', true),
                            $('input[name=age]').val(response.child['age'].split(' ')[0].split('-').reverse().join('/')),
                            $('select[name=subscriber_id]').val(),
                            $('#vis').val()
                    console.log(response);
                    return false
                    $("#visits_"+id).text(response.decrease['remainder']);
                    $("#last_"+id).text(response.decrease['last_visit']);
                    if(response.decrease['remainder'] == 0){
                        button.addClass('disabled');
                    }*/
                },
                error: function () {
                    console.log('error');
                }
            });
        }
        /*
        function actionShow(e) {
            var button = $(e);
            var id = button.parent().attr('item');
            $("#add_visitors").modal('show')
            $('#insert-submit').hide();
            $('#update-button').show();
            //console.log(id)
            //return false
            var postData = {
                "id": id,
                "branch_id": "{{ $branch->id }}"
            }
            $.ajax({
                type: "POST",
                url: "{{ route('child.edit') }}",
                data: postData,
                success: function (response) {
                    var gen = response.child['gender'];
                    //console.log(response.decrease['remainder']);
                    $('input[name=name]').val(response.customer['name']);
                    $('input[name=phone]').val(response.customer['phone']);
                    $('input[name=post]').val(response.customer['post']);
                            //"social": arr,
                            $('input[name=child_name]').val(response.child['child_name']),
                            $('input[name=gender][value='+gen+']').prop('checked', true),
                            $('input[name=age]').val(response.child['age'].split(' ')[0].split('-').reverse().join('/')),
                            $('select[name=subscriber_id]').val(),
                            $('#vis').val()
                    console.log(response);
                    return false
                    $("#visits_"+id).text(response.decrease['remainder']);
                    $("#last_"+id).text(response.decrease['last_visit']);
                    if(response.decrease['remainder'] == 0){
                        button.addClass('disabled');
                    }
                },
                error: function () {
                    console.log('error');
                }
            });
        }*/

    </script>
@stop