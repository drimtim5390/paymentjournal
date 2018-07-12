@extends('layouts.default')
@section('title')
    Лизинг калкулятор
@endsection
@section('content')
<div class="card">
    <div class="card-header">
        Лизинг калкулятор
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col">
                <label>Маҳсулот тўлов суммаси:</label>
                <input class="form-control" type="number" id="sum" onkeyup="calc()">
            </div>
            <div class="col">
                <label>Олдиндан тўлов, %</label>
                <input type="number" class="form-control" id="pre" onkeyup="calc()" value="30">
            </div>
            <div class="col">
                <label>Комиссия, %</label>
                <input type="number" class="form-control" id="com" onkeyup="calc()" value="3">
            </div>
            <div class="col">
                <label>Лизинг, %</label>
                <input type="number" class="form-control" id="liz" onkeyup="calc()" value="30">
            </div>
            <div class="col">
                <label>Муддати, ой</label>
                <input type="number" class="form-control" id="fem" onkeyup="calc()" value="12">
            </div>
        </div>  
        <div class="row">
            <div class="col">
                <label>Умумий тўлов суммаси:</label>
                <p class="alert alert-info" id="suma">...</p>
            </div>
            <div class="col">
                <label>Олдиндан тўлов</label>
                <p class="alert alert-info" id="prea">...</p>
            </div>
            <div class="col">
                <label>Комиссия</label>
                <p class="alert alert-info" id="coma">...</p>
            </div>
            <div class="col">
                <label>Лизинг</label>
                <p class="alert alert-info" id="liza">...</p>
            </div>
            <div class="col">
                <label>Ойлик тўлов</label>
                <p class="alert alert-info" id="fema">...</p>
            </div>
        </div> 
        <table class="table table-hover table-bordered table-striped table-sm">
            <thead>
            <tr>
                <td width="10%">
                    №
                </td>
                <td width="20%">
                    Сана
                </td>
                <td width="35%">
                    Ойига
                </td>
                <td width="35%">
                    Қолдиқ
                </td>
            </tr>
            </thead>
            <tbody id="tbody">
            @for($i = 1; $i <= 12; $i++)
                <tr>
                    <td>
                        {{$i}}
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            @endfor
            </tbody>
        </table>    
    </div>
    <div class="card-footer">

    </div>
</div>
<script>
    function calc(){
        Number.prototype.format = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~n));

            return (c ? num.replace('.', c) : num).replace(new RegExp(re, 'g'), '$&' + (s || ','));
        };
        Number.prototype.beauty = function(n, x, s, c) {
            var re = '\\d(?=(\\d{' + (3 || 3) + '})+' + (2 > 0 ? '\\D' : '$') + ')',
                num = this.toFixed(Math.max(0, ~~2));

            return ('.' ? num.replace('.', '.') : num).replace(new RegExp(re, 'g'), '$&' + (' ' || ','));
        };

        var sum = document.getElementById("sum").value;
        var pre = document.getElementById("pre").value;
        var com = document.getElementById("com").value;
        var liz = document.getElementById("liz").value;
        var fem = document.getElementById("fem").value;

        var prea = sum*pre/100;
        var coma = sum*com/100;
        var liza = (sum-prea)*(1+liz/100);
        var fema = liza/fem;

        document.getElementById("suma").innerHTML = (liza+prea).beauty();
        document.getElementById("prea").innerHTML = (prea+coma).beauty();
        document.getElementById("coma").innerHTML = (coma).beauty();
        document.getElementById("liza").innerHTML = (liza).beauty();
        document.getElementById("fema").innerHTML = (fema).beauty();
        
        var tbody = document.getElementById("tbody");
        tbody.innerHTML = "";
        
        var s = liza;
        var today = new Date();
        var d = today.getDate();
        var m = today.getMonth()+1;
        var y = today.getFullYear();
        for (let i = 1; i <= fem; i++) {
            var tr = document.createElement("tr");

            var td = document.createElement("td");
            td.append(i);
            tr.append(td);

            m++;
            if(m==13){
                y++;
                m=1;
            }

            var td = document.createElement("td");
            var dd="";
            if((d.toString()).length==1){
                dd="0"+d.toString();
            }else{
                dd=d.toString();
            }
            var mm="";
            if((m.toString()).length==1){
                mm="0"+m.toString();
            }else{
                mm=m.toString();
            }
            td.append(dd+"."+mm+"."+y);
            tr.append(td);
            
            var td = document.createElement("td");
            td.append(fema.beauty());
            tr.append(td);

            var td = document.createElement("td");
            s-=fema;
            td.append((s).beauty());
            tr.append(td);
            
            tbody.append(tr);
        }
    }
    </script>
@endsection