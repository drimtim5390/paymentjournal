@extends('layouts.default')
@section('title')
    Тўлов амалга ошириш
@endsection
@section('content')
<div class="col-md-12">

    <form method="POST" action="/pay">
    {{csrf_field()}}
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
                        <input id="madedate" class="form-control alert alert-light border-secondary" type="date" name="madedate" required>
                    </div>
                    <div class="col-md-2">
                        <label>Тўлов суммаси</label>
                        <input autofocus class="form-control alert alert-light border-secondary" type="number" name="summ" required placeholder="{{number_format($export->summ*0.91/12,'2','.',' ')}}">
                    </div>
	        	</div>
            </div>

            <div class="card-footer">
                <input type="hidden" name="export_id" value="{{$export->id}}">
                 <input type="submit" class="float-right btn btn-success btn-sm" value="Тўлаш">
            </div>
    </div>
    </form>
</div>
    <script>
        Date.prototype.toDateInputValue = (function() {
            var local = new Date(this);
            local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
            return local.toJSON().slice(0,10);
        });
        document.getElementById('madedate').value = new Date().toDateInputValue();
    </script>
@endsection