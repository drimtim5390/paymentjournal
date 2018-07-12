@extends('layouts.default')
@section('title')
    Статистика
@endsection
@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Умумий савдо ҳажми
                </div>
                <div class="card-body">
                    {{number_format($summa,'2','.',' ')}}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Барча тўловлар
                </div>
                <div class="card-body">
                    {{number_format($payed,'2','.',' ')}}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-header">
                    Мижозлар умумий қарзи
                </div>
                <div class="card-body">
                    {{number_format($diff,'2','.',' ')}}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-3 offset-3">
            <div class="card">
                <div class="card-header">
                    Комиссия тўловлар
                </div>
                <div class="card-body">
                    {{number_format($coma,'2','.',' ')}}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card">
                <div class="card-header">
                    Ортиқча тўловлар
                </div>
                <div class="card-body">
                    {{number_format($hig,'2','.',' ')}}
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>

    </div>
@endsection