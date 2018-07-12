<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Export;
use App\Payment;
use Illuminate\Http\Request;


class CustomersController extends Controller
{
    public function all()
    {
        $exports = Export::orderBy('exportdate','desc')->get();
        return view('customers.all', compact('exports'));
    }

    public function index()
    {
        $exports = Export::where('remains','>',0)->orderBy('paymentdate','asc')->get();
        return view('customers.index', compact('exports'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'birthdate' => 'required|date',
            'phonenumber' => 'required|max:50',
            'adress' => 'required|max:500',
            'comment' => 'max:500',
            'pserie' => 'required|max:2',
            'pnumber' => 'required|max:7',
            'pgivenby' => 'required|max:400',
            'pgivendate' => 'required|date',
            'exportdate' => 'required|date',
            'summ' => 'required|numeric',
            'pre' => 'required|numeric',
            'com' => 'required|numeric',
            'liz' => 'required|numeric',
            'fem' => 'required|numeric',
        ]);
        $customer = Customer::create([
            'name' => $request->name,
            'pserie' => $request->pserie,
            'pnumber' => $request->pnumber,
            'pgivenby' => $request->pgivenby,
            'pgivendate' => $request->pgivendate,
            'birthdate' => $request->birthdate,
            'phonenumber' => $request->phonenumber,
            'phonenumber1' => $request->phonenumber1,
            'adress' => $request->adress,
            'comment' => $request->comment,
        ]);
        Export::create([
            'customer_id' => $customer->id,
            'summ' => $request->summ,
            'pre' => $request->pre,
            'com' => $request->com,
            'liz' => $request->liz,
            'fem' => $request->fem,
            'exportdate' => $request->exportdate,
            'remains' => $request->summ,
            'paymentdate' => $request->exportdate,
        ]);
        return redirect('/');
    }

    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        return view('customers.show',compact('customer'));
    }

    public function edit($id)
    {
        $export = Export::findOrFail($id);
        return view('customers.edit',compact('export'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:100',
            'birthdate' => 'required|date',
            'phonenumber' => 'required|max:50',
            'adress' => 'required|max:500',
            'comment' => 'max:500',
            'pserie' => 'required|max:2',
            'pnumber' => 'required|max:7',
            'pgivenby' => 'required|max:400',
            'pgivendate' => 'required|date',
            'exportdate' => 'required|date',
            'summ' => 'required|numeric',
            'pre' => 'required|numeric',
            'com' => 'required|numeric',
            'liz' => 'required|numeric',
            'fem' => 'required|numeric',
        ]);
        $customer = Customer::findOrFail(Export::findOrFail($id)->customer->id);
        $customer->update([
            'name' => $request->name,
            'pserie' => $request->pserie,
            'pnumber' => $request->pnumber,
            'pgivenby' => $request->pgivenby,
            'pgivendate' => $request->pgivendate,
            'birthdate' => $request->birthdate,
            'phonenumber' => $request->phonenumber,
            'phonenumber1' => $request->phonenumber1,
            'adress' => $request->adress,
            'comment' => $request->comment,
        ]);
        $export = Export::findOrFail($id);
        $export->update([
            'summ' => $request->summ,
            'pre' => $request->pre,
            'com' => $request->com,
            'liz' => $request->liz,
            'fem' => $request->fem,
            'exportdate' => $request->exportdate,
            'paymentdate' => $request->exportdate,
        ]);
        return redirect('/');
    }

    public function destroy($id)
    {
        Customer::destroy(Export::findOrFail($id)->customer->id);
        $export = Export::findOrFail($id);
        foreach ($export->payments as $payment){
            $payment->delete();
        }
        $export->delete();
           return redirect('/all');
    }
}
