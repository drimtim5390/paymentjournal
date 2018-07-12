@extends('layouts.default')
@section('title')
    Барча мижозлар
@endsection
@section('content')
<style>
.table thead th{
    vertical-align: middle;
    text-align: center;
}
.table tbody td{
    vertical-align: middle;
}
</style>
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        Барча товарлар
                    </div>
                    <div class="col-md-3">
                        <input class="form-control form-control-sm" id="name" placeholder="Ф.И.Ш" onkeyup="reloadn()">
                    </div>
                    <div class="col-md-3">
                        <input class="form-control form-control-sm" id="pserie" placeholder="Паспорт серия" onkeyup="reloadp()">
                    </div>
                    <div class="col-md-3">
                        <a href="/create" class="float-right btn btn-success btn-sm">Мижоз қўшиш</a>
                    </div>

                </div>
            </div>
            <div class="card-body" style="overflow-x: auto">
                <table class="table table-hover table-striped table-bordered table-sm">
                    <thead>
                        <tr>
                            <th width="25">
                                №
                            </th>
                            <th>
                                Ф.И.Ш.
                            </th>
                            <th width="110">
                                Паспорт серияси
                            </th>
                            <th width="130">
                                Телефон
                            </th>
                            <th width="140">
                                Қолдиқ
                            </th>
                            <th width=160>
                                Тўлов муддати
                            </th>
                            <th width=120>
                                Муддатли тўлов камомади
                            </th>
                            <th width="70">
                                Тўлов
                            </th>
                        </tr>
                    </thead>
                    <tbody id="tbody">
                        <?php $inc = 0 ?>
                        @forelse($exports as $export)
                        @if($export->suma>$export->payed)
                        <?php
                            $today = date('d.m.Y');
                            $time = $export->paymentdate->format('d.m.Y');
                            $diff = round((strtotime($time)-(strtotime($today)))/(60*60*24));
                        ?>
                            <tr id="customer{{$export->id}}"
                                @if($diff<=0)
                                    class="table-danger"
                                @else
                                    @if($diff<=3)
                                        class="table-warning"
                                    @endif
                                @endif
                                onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer"
                            >
                                <td>
                                    {{++$inc}}
                                </td>
                                <td>
                                    {{$export->customer->name}}
                                </td>
                                <td>
                                    {{strtoupper($export->customer->pserie.$export->customer->pnumber)}}
                                </td>
                                <td align="right">
                                    {{$export->customer->phonenumber}}
                                </td>
                                <td align="right">
                                    {{number_format($export->remains,2,'.',' ')}}
                                </td>
                                <td align="right">
                                    {{$export->paymentdate->format('d.m.Y').' ('.$diff.')'}}
                                </td>
                                <td align="right"
                                    @if($export->shortage<0)
                                        class="table-danger"
                                    @endif
                                >
                                    @if($export->shortage>=0)
                                        Йўқ
                                    @else
                                        {{number_format($export->shortage,2,'.',' ')}}
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="/pay/{{$export->id}}">Тўлов</a>
                                </td>
                            </tr>
                        @endif
                        @empty
                            <tr>
                                <td colspan="8">
                                    Mijozlar mavjud emas!!!
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
<script>
    var trs = new Array({{count($exports)}});
        @forelse($exports as $export)
            trs['{{$export->id}}']=document.getElementById("customer{{$export->id}}").outerHTML;
        @empty
        @endforelse
    var names = new Array({{count($exports)}});
        @forelse($exports as $export)
        names['{{$export->id}}']="{{$export->customer->name}}";
        @empty
        @endforelse
    var pseries = new Array({{count($exports)}});
        @forelse($exports as $export)
        pseries['{{$export->id}}']="{{$export->customer->pserie}}";
        @empty
        @endforelse

    function nfilterItems(query) {
        return names.filter(function(el) {
            return el.toLowerCase().indexOf(query.toLowerCase()) > -1;
        });
    }

    function pfilterItems(query) {
        return pseries.filter(function(el) {
            return el.toLowerCase().indexOf(query.toLowerCase()) > -1;
        });
    }

    function reloadn(){
        var name = document.getElementById("name").value;
        var ans = new Set(nfilterItems(name));
        var tbody = document.getElementById("tbody");
        tbody.innerHTML="";
        var bod = "";
        ans.forEach(function(item){
            bod+=trs[names.indexOf(item)];
        });
        tbody.innerHTML=bod;
    }
    function reloadp() {
        var pserie = document.getElementById("pserie").value;
        var ans = new Set(pfilterItems(pserie));
        var tbody = document.getElementById("tbody");
        tbody.innerHTML="";
        var bod = "";
        ans.forEach(function(item){
            bod+=trs[pseries.indexOf(item)];
        });
        tbody.innerHTML=bod;
    }
</script>
</div>
@endsection
