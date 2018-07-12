@extends('layouts.default')
@section('title')
    Тўлов амалга ошириш
@endsection
@section('content')
    <div class="col-md-12">
        <form method="POST" action="/pay/{{$payment->id}}">
            {{csrf_field()}}
            {{method_field("PUT")}}
            <div class="card">
                <div class="card-header">
                    Тўлов
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Ф.И.Ш</label>
                            <div class="alert alert-dark">{{$export->customer->name}}</div>
                        </div>
                        <div class="col-md-2">
                            <label>Паспорт серия</label>
                            <div class="alert alert-dark">{{strtoupper($export->customer->pserie.$export->customer->pnumber)}}</div>
                        </div>
                        <div class="col-md-2">
                            <label>Қолдиқ</label>
                            <div class="alert alert-dark">{{number_format($export->remains,2,'.',' ')}}</div>
                        </div>
                        <div class="col-md-3">
                            <label>Тўлов санаси</label>
                            <input id="madedate" class="form-control alert alert-light border-secondary" type="date" name="madedate" required value="{{$payment->madedate->format('Y-m-d')}}">
                        </div>
                        <div class="col-md-2">
                            <label>Тўлов суммаси</label>
                            <input class="form-control alert alert-light border-secondary" autofocus type="number" name="summ" required value="{{$payment->summ}}">
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <input type="submit" class="float-right btn btn-primary btn-sm" value="Ўзгартириш">
                </div>
            </div>
        </form>
    </div>
@endsection