<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Export;
use App\Payment;
class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $export = Export::findOrFail($id);
        return view('payments.create', compact('export'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Payment::create([
            'export_id' => $request->export_id,
            'summ' => $request->summ,
            'madedate' => $request->madedate,
        ]);
        $export = Export::findOrFail($request->export_id);
        $export->update([
            'paymentdate' => $export->exportdate,
        ]);
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::findOrFail($id);
        $export = Export::findOrFail($payment->export->id);
        return view('payments.edit',compact('payment','export'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $payment->update([
           'madedate' => $request->madedate,
            'summ' => $request->summ,
        ]);
        $export = $payment->export;
        $export->update([
            'paymentdate' => $export->exportdate,
        ]);

        return redirect('/'.$payment->export->customer_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $export = Payment::findOrFail($id)->export;
        Payment::destroy($id);
        $export->update([
            'paymentdate' => $export->exportdate,
        ]);
        return redirect('/'.$export->customer_id);
    }
}
