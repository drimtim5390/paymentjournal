@extends('layouts.default')
@section('title')
    Мижоз қўшиш
@endsection
@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Мижоз маълумотлари
                <a href="/{{$customer->export->id}}/edit" class="float-right btn btn-primary btn-sm">Таҳрир</a>
            </div>
            <div class="card-body">
                <label>Ф.И.Ш:</label>
                <p class="alert alert-dark">{{$customer->name}}</p>
                <div class="row">
                    <div class="col-md-3">
                        <label>Туғилган сана:</label>
                        <p class="alert alert-dark">{{$customer->birthdate->format('d.m.Y')}}</p>
                    </div>
                    <div class="col-md-3">
                        <label>Телефон:</label>
                        <p class="alert alert-dark">{{$customer->phonenumber}}<br>{{$customer->phonenumber1}}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Манзил:</label>
                        <p class="alert alert-dark">{{$customer->adress}}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Паспорт серияси:</label>
                        <p class="alert alert-dark">{{strtoupper($customer->pserie.$customer->pnumber)}}</p>
                    </div>
                    <div class="col-md-3">
                        <label>Берилган сана:</label>
                        <p class="alert alert-dark">{{$customer->pgivendate->format('d.m.Y')}}</p>
                    </div>
                    <div class="col-md-6">
                        <label>Ким томонидан берилган:</label>
                        <p class="alert alert-dark">{{$customer->pgivenby}}</p>
                    </div>
                </div>
                <label>Қўшимча маълумот:</label>
                <div class="alert alert-dark">{{$customer->comment==""?"Маълумот мавжуд эмас!":$customer->comment}}</div>
                <div class="row">
                    <div class="col-md-4">
                        <label>Шартнома тузилган сана:</label>
                        <p class="alert alert-dark">{{$customer->export->exportdate->format('d.m.Y')}}</p>
                    </div>
                    <div class="col-md-4">
                        <label>Шартнома суммаси:</label>
                        <p class="alert alert-dark">{{number_format($customer->export->summ,2,'.',' ')}}</p>
                    </div>
                    <div class="col-md-4">
                        <label>Қолдиқ сумма:</label>
                        <p class="alert alert-dark">{{number_format($customer->export->remains,2,'.',' ')}}</p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="alert alert-dark">
                    <div class="row">
                        <div class="col">
                            Тўловлар
                        </div>
                        <div class="col">
                            <a href="/pay/{{$customer->export->id}}" class="float-right btn btn-primary btn-sm">Тўлов</a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>
                                №
                            </th>
                            <th>
                                Сумма
                            </th>
                            <th>
                                Санаси
                            </th>
                            <th colspan="2">
                                Амаллар
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $int=0?>
                        @forelse($customer->export->payments as $payment)
                        <tr>
                            <td>
                                {{++$int}}
                            </td>
                            <td>
                                {{number_format($payment->summ,2,'.',' ')}}
                            </td>
                            <td>
                                {{$payment->madedate->format('d.m.Y')}}
                            </td>
                            <td width="100">
                                <a class="btn btn-sm btn-primary" href="/pay/{{$payment->id}}/edit">
                                    Таҳрир
                                </a>
                            </td>
                            <td width="100">
                                <form onsubmit="return confirm('Ushbu mijozni bazadan o`chirishni tasdiqlang:\n{{$payment->summ}}')" action="/pay/{{$payment->id}}" method="POST" style="margin-bottom: 0">
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
                            <td colspan="4">
                                Тўловлар мавжуд эмас!!!
                            </td>
                        </tr>
                        @endforelse
                        <tr>

                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                Тўловлар
            </div>
            <div class="card-body">
                <label>Умумий тўлов суммаси:</label>
                <p class="alert alert-info">{{number_format($customer->export->suma,'2','.',' ')}}</p>
                <label>Тўланди:</label>
                <p class="alert alert-info">{{number_format($customer->export->payed,'2','.',' ')}}</p>
                <label>Қолдиқ:</label>
                <p class="alert alert-info">{{number_format($customer->export->remains,'2','.',' ')}}</p>
                <label>Ҳар ой учун тўлов:</label>
                <p class="alert alert-info">{{number_format($each = $customer->export->fema,'2','.',' ')}}</p>
                <table class="table table-hover table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <td>
                                №
                            </td>
                            <td>
                                Сана
                            </td>
                            <td>
                                Ойига
                            </td>
                            <td>
                                Қолдиқ
                            </td>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 1; $i <= $customer->export->fem; $i++)
                        <tr >
                            <td>
                                {{$i}}
                            </td>
                            <td>
                                {{$customer->export->exportdate->addMonth($i)->format('d.m.Y')}}
                            </td>
                            <td>
                                {{number_format($customer->export->fema,'2','.',' ')}}
                            </td>
                            <td>
                                {{number_format($customer->export->liza-$customer->export->fema*$i,'2','.',' ')}}
                            </td>
                        </tr>

                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="card-footer">


            </div>
        </div>
    </div>
</div>
@endsection
