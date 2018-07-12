<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Export extends Model
{
    protected $fillable = [
        'summ','exportdate','customer_id','remains','paymentdate','pre','com','liz','fem'
    ];
    protected $dates = [
        'exportdate','paymentdate'
    ];
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function payments(){
        return $this->hasMany(Payment::class);
    }
    public function getPreaAttribute(){
        return $this->summ*$this->pre/100;
    }
    public function getComaAttribute(){
        return $this->summ*$this->com/100;
    }
    public function getLizaAttribute(){
        return $this->summ*(1-$this->pre/100)*(1+$this->liz/100);
    }
    public function getSumaAttribute(){
        return $this->prea+$this->liza;
    }
    public function getFemaAttribute(){
        return $this->liza/$this->fem;
    }
    public function getPayedAttribute(){
        $payed = 0;
        foreach ($this->payments as $payment){
            $payed+=$payment->summ;
        }
        return $payed;
    }
    public function setRemainsAttribute(){
        $this->attributes['remains'] = $this->suma;
    }
    public function getRemainsAttribute(){
        return $this->suma-$this->payed;
    }
    public function getShortageAttribute(){
        $end = Carbon::parse($this->exportdate);
        $now = Carbon::now();
        $diff = $end->diffInMonths($now)+1;

        $shbp = min($diff*$this->fema+$this->prea, $this->suma);

        return $this->payed-$shbp;
    }
    public function setPaymentdateAttribute($value){
        $date = Carbon::parse($this->exportdate);
        if($this->payed-$this->prea>=0){
            $liza = $this->payed-$this->prea;
            $s = ceil($liza/$this->fema);
            if($s==0){
                $date->addMonths(1);
            }else{
                $date->addMonths($s);
            }
            $this->attributes['paymentdate'] = $date;
        }else{
            $this->attributes['paymentdate'] = $date;
        }
    }
}
