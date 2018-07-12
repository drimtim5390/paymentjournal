<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name', 'pserie','pnumber', 'pgivenby','pgivendate','birthdate','phonenumber','phonenumber1','adress','comment',
    ];
    protected $dates = [
        'pgivendate','birthdate'
    ];

    public function export(){
        return $this->hasOne(Export::class);
    }
}
