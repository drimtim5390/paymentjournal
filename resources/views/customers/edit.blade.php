@extends('layouts.default')
@section('title')
    Мижоз қўшиш
@endsection
@section('content')
    <div class="col">
        <form method="POST" action="/{{$export->id}}">
            {{method_field("PUT")}}
            {{csrf_field()}}
            <div class="form-group">
                <div class="card">
                    <div class="card-header">
                        Мижоз таҳрирлаш
                    </div>
                    <div class="card-body">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <label for="name">Ф.И.Ш</label>
                        <input autofocus type="text" class="form-control" id="name" name="name" value="{{$export->customer->name}}">
                        <div class="row">
                            <div class="col">
                                <label for="birthdate">Туғилган сана</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate" value="{{$export->customer->birthdate->format("Y-m-d")}}">
                            </div>
                            <div class="col">
                                <label for="phonenumber">Телефон</label>
                                <input type="text" class="form-control" id="phonenumber" name="phonenumber" value="{{$export->customer->phonenumber}}">
                            </div>
                            <div class="col">
                                <label for="phonenumberextra">Телефон (қўшимча)</label>
                                <input type="text" class="form-control" id="phonenumberextra" name="phonenumberextra" value="{{$export->customer->phonenumber1==''?'+998':$export->customer->phonenumber1}}">
                            </div>
                            <div class="col-md-5">
                                <label for="adress">Манзил</label>
                                <input type="text" class="form-control" id="adress" name="adress" value="{{$export->customer->adress}}">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="pserie">Паспорт серияси</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control" id="pserie" name="pserie" value="{{$export->customer->pserie}}">
                                            <option value="AA">
                                                AA
                                            </option>
                                            <option value="AB">
                                                AB
                                            </option>
                                            <option value="AC">
                                                AC
                                            </option>
                                            <option value="CR">
                                                CR
                                            </option>
                                            <option value="CT">
                                                CT
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" id="pnumber" name="pnumber" value="{{$export->customer->pnumber}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <label for="pgivendate">Берилган сана</label>
                                <input type="date" class="form-control" id="pgivendate" name="pgivendate" value="{{$export->customer->pgivendate->format('Y-m-d')}}">
                            </div>
                            <div class="col-md-6">
                                <label for="pgivenby">Ким томонидан берилган</label>
                                <select class="form-control" id="pgivenby" name="pgivenby">
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти ИИБ') selected @endif value="Хоразм вилояти ИИБ">
                                        Хоразм вилояти ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Урганч шаҳар ИИБ') selected @endif value="Хоразм вилояти Урганч шаҳар ИИБ">
                                        Хоразм вилояти Урганч шаҳар ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Урганч туман ИИБ') selected @endif value="Хоразм вилояти Урганч туман ИИБ">
                                        Хоразм вилояти Урганч туман ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Хонқа туман ИИБ') selected @endif value="Хоразм вилояти Хонқа туман ИИБ">
                                        Хоразм вилояти Хонқа туман ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Янгиариқ туман ИИБ') selected @endif value="Хоразм вилояти Янгиариқ туман ИИБ">
                                        Хоразм вилояти Янгиариқ туман ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Янгибозор туман ИИБ') selected @endif value="Хоразм вилояти Янгибозор туман ИИБ">
                                        Хоразм вилояти Янгибозор туман ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Қўшкўпир туман ИИБ') selected @endif value="Хоразм вилояти Қўшкўпир туман ИИБ">
                                        Хоразм вилояти Қўшкўпир туман ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Хазорасп туман ИИБ') selected @endif value="Хоразм вилояти Хазорасп туман ИИБ">
                                        Хоразм вилояти Хазорасп туман ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Гурлан туман ИИБ') selected @endif value="Хоразм вилояти Гурлан туман ИИБ">
                                        Хоразм вилояти Гурлан туман ИИБ
                                    </option>
                                    <option @if(old('pgivenby',$export->customer->pgivenby) == 'Хоразм вилояти Хива туман ИИБ') selected @endif value="Хоразм вилояти Хива туман ИИБ">
                                        Хоразм вилояти Хива туман ИИБ
                                    </option>
                                </select>
                            </div>
                        </div>
                        <label for="comment">Қўшимча маълумот</label>
                        <textarea class="form-control" type="text" id="comment" name="comment">{{$export->customer->comment}}</textarea>
                        <div class="row">
                            <div class="col-md-3">
                                <label for="exportdate">Шартнома тузилган сана</label>
                                <input class="form-control" type="date" id="exportdate" name="exportdate" value="{{$export->exportdate->format('Y-m-d')}}">
                            </div>
                            <div class="col">
                                <label for="summ">Шартнома суммаси</label>
                                <input class="form-control" type="number" id="sum" name="summ" value="{{$export->summ}}" onkeyup="calc()">
                            </div>
                            <div class="col">
                                <label for="pre">Олдиндан тўлов, %</label>
                                <input class="form-control" type="number" id="pre" name="pre" value="{{$export->pre}}" onkeyup="calc()">
                            </div>
                            <div class="col">
                                <label for="com">Комиссия, %</label>
                                <input class="form-control" type="number" id="com" name="com" value="{{$export->com}}" onkeyup="calc()">
                            </div>
                            <div class="col">
                                <label for="liz">Лизинг, %</label>
                                <input class="form-control" type="number" id="liz" name="liz" value="{{$export->liz}}" onkeyup="calc()">
                            </div>
                            <div class="col">
                                <label for="fem">Шартнома муддати</label>
                                <input class="form-control" type="number" id="fem" name="fem" value="{{$export->fem}}" onkeyup="calc()">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label>Умумий тўлов суммаси:</label>
                                <p class="alert alert-info" id="suma"></p>
                            </div>
                            <div class="col">
                                <label>Олдиндан тўлов</label>
                                <p class="alert alert-info" id="prea"></p>
                            </div>
                            <div class="col">
                                <label>Комиссия</label>
                                <p class="alert alert-info" id="coma"></p>
                            </div>
                            <div class="col">
                                <label>Лизинг</label>
                                <p class="alert alert-info" id="liza"></p>
                            </div>
                            <div class="col">
                                <label>Ойлик тўлов</label>
                                <p class="alert alert-info" id="fema"></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" value="Тасдиқлаш" class="float-right btn btn-success">
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        calc();
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
        }
    </script>
@endsection