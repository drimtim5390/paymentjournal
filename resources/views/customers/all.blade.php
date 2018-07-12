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
                            <th width="300">
                                Ф.И.Ш.
                            </th>
                            <th width="110">
                                Паспорт серияси
                            </th>
                            <th width="130">
                                Телефон
                            </th>
                            <th width="140">
                                Туғилган сана
                            </th>
                            <th width="250">
                                Манзил
                            </th>
                            <th width="140">
                                Шартнома санаси
                            </th>
                            <th width="200" colspan="2">
                                Амаллар
                            </th>
                        </tr>
                        </thead>
                        <tbody id="tbody">
                        <?php $inc = 0 ?>
                        @forelse($exports as $export)
                            <tr id="customer{{$export->id}}"
                                @if($export->payed>$export->suma)
                                    class="table-success"
                                @endif
                                @if($export->payed<$export->suma)
                                    class="table-warning"
                                @endif

                            >
                                <td onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer">
                                    {{++$inc}}
                                </td>
                                <td onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer">
                                    {{$export->customer->name}}
                                </td>
                                <td onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer">
                                    {{strtoupper($export->customer->pserie.$export->customer->pnumber)}}
                                </td>
                                <td align="right" onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer">
                                    {{$export->customer->phonenumber}}
                                </td>
                                <td align="right" onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer">
                                    {{$export->customer->birthdate->format('d.m.Y')}}
                                </td>
                                <td onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer">
                                    {{$export->customer->adress}}
                                </td>
                                <td align="right" onclick="document.location = '/{{$export->customer_id}}';" style="cursor:pointer">
                                    {{$export->exportdate->format('d.m.Y')}}
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-primary" href="/{{$export->id}}/edit">
                                        Таҳрир
                                    </a>
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Ushbu mijozni bazadan o`chirishni tasdiqlang:\n{{$export->customer->name}}')" action="/{{$export->id}}" method="POST" style="margin-bottom: 0">
                                        {{method_field("DELETE")}}
                                        {{csrf_field()}}
                                        <button class="btn btn-danger btn-sm" style="vertical-align: middle">
                                            Ўчириш
                                        </button>
                                    </form>
                                </td>
                            </tr>
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
