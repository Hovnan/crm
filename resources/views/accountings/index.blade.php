@extends('main')
@section('content')
    <div id="page-wrapper">
        <div class="graphs">
            <div class="md">
                <h3 class="blank1">Бухгалтерия</h3>
                <div class="form-group">
                    <div class="row">
                        <div class="col-md-4">
                            <button data-toggle="modal" data-target="#add_action" type="button" class="btn btn-info btn-cust">Добавить операцию</button>
                        </div>
                    </div>
                </div>
                <form action="" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-2 grid_box1">
                                <label class="control-label" for="status">Период операции</label>
                                <select class="form-control1" id="status" name="status">
                                    <option value="0">Month</option>
                                    <option value="0">Month 1</option>
                                    <option value="0">Month 2</option>
                                    <option value="0">Month 3</option>
                                </select>
                            </div>
                            <div class="col-md-1 grid_box1">
                                <label class="control-label" for="status1">&nbsp;</label>
                                <select class="form-control1" id="status1" name="status1">
                                    <option value="0">Year</option>
                                    <option value="0">Year 1</option>
                                    <option value="0">Year 2</option>
                                    <option value="0">Year 3</option>
                                </select>
                            </div>
                            <div class="col-md-2  col-md-offset-1 grid_box1">
                                <label class="control-label" for="min_year">Вид доходов</label>
                                <select class="form-control1" id="min_year" name="min_year">
                                    <?
                                    for($i=4;$i<=15;$i++)
                                    {
                                    ?>
                                    <option value="<?=$i?>"><?=$i?></option>
                                    <?
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 grid_box1">
                                <label class="control-label" for="min_year">Вид расходов</label>
                                <select class="form-control1" id="max_year" name="max_year">
                                    <option>Menu</option>
                                    <option>Menu</option>
                                    <option>Menu</option>
                                </select>
                            </div>
                            <div class="col-md-1 grid_box1">
                                <label class="control-label" for="abonement">Кол. строк</label>
                                <select class="form-control1" id="abonement" name="abonement">
                                    <option value="0">Все</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            <div class="col-md-1 col-md-offset-1">
                                <label class="control-label" for="">&nbsp;</label>
                                <button type="submit" class="btn btn-info btn-cust btn-block">Найти</button>
                            </div>
                        </div>
                    </div>
                    <hr />
                    <div class="clearfix"> </div>
                </form>
            </div>
            <table id="client_table" class="table table-bordered col-xs-10 text-center">
                <thead>
                <tr>
                    <th>N</th>
                    <th>Дата</th>
                    <th>Доходы</th>
                    <th>Расходы</th>
                    <th>Комментарии</th>
                    <th>Остаток</th>
                </tr>
                </thead>
                <tbody>
                @foreach($accountings as $accounting)
                    <tr>
                        <td>{{ $accounting->id }}</td>
                        <td>{{ $accounting->when }}</td>
                        <td>Доходы</td>
                        <td>Расходы</td>
                        <td>{{ $accounting->coment }}</td>
                        <td>Остаток</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="add_action" role="dialog" >
        <div class="modal-dialog modal-md">
            <div class="modal-content text-muted border-0">
                <div class="modal-header z-type">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <div class="container-fluid">
                        <!-- Контейнер, в котором можно создавать классы системы сеток -->
                        <div class="row">
                            <div class="col-md-12">
                                <h3 class="modal-title">Добавить операцию</h3>
                                <span class="f-type">Вам необходимо заполнить форму</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">

                        <form action="{{ route('accounting.store', ['branch' => $branch->id]) }}" method="post">
                            {{ csrf_field() }}
                            <div class="row pad-b10">
                                <div class="col-xs-8">
                                    <p>Вид операции</p>
                                    <!--<select class="form-control" id="status" name="">
                                        <option value="0">Расходы</option>
                                        <option value="0">Расходы<</option>
                                        <option value="0">Расходы< 2</option>
                                        <option value="0">Расходы< 3</option>
                                    </select>-->
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="row pad-b10">
                                <div class="col-xs-4">
                                    <p>Сумма</p>
                                    <input type="text" class="form-control" name="amount">
                                </div>
                            </div>
                            <div class="row pad-b10">
                                <input type="text" name="when" class="form-control">
                                <!--<div class="col-xs-2">
                                    <p>День</p>
                                    <select class="form-control" id="status" name="">
                                        <option value="0">День</option>
                                        <option value="0">День</option>
                                        <option value="0">День</option>
                                        <option value="0">День</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <p>Месяц</p>
                                    <select class="form-control" id="status" name="">
                                        <option value="0">Месяц</option>
                                        <option value="0">Месяц</option>
                                        <option value="0">Месяц</option>
                                        <option value="0">Месяц</option>
                                    </select>
                                </div>
                                <div class="col-xs-3">
                                    <p>Год</p>
                                    <select class="form-control" id="status" name="">
                                        <option value="0">Год</option>
                                        <option value="0">Год</option>
                                        <option value="0">Год</option>
                                        <option value="0">Год</option>
                                    </select>
                                </div>-->
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <!--<label for="comment">Комментарии</label>-->
                                    <p for="comment">Комментарии</p>
                                    <textarea class="form-control" rows="5" id="comment" name="coment"></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <button type="submit" class="btn btn-info pull-left btn-cust">Сохранить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="modal-footer x-type">
                    <div class="container-fluid">
                        <!--<div class="row">
                            <div class="col-md-8">
                                <button type="button" class="btn btn-info pull-left btn-cust">Сохранить</button>
                            </div>
                        </div>-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Modal -->
@stop