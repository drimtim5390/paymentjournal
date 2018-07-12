<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'export_id','summ','madedate'
    ];
    protected $dates = [
        'madedate'
    ];
    public function export(){
        return $this->belongsTo(Export::class);
    }
    public function setMadedateAttribute($value){
        $this->attributes['madedate'] = Carbon::parse($value);
    }
}
