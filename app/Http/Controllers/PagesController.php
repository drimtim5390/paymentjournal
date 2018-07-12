<?php

namespace App\Http\Controllers;

use App\Export;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function lcalc(){
        return view('pages.lcalc');
    }
    public function stats(){
        $exports = Export::all();
        $summa = 0;
        $payed = 0;
        $coma = 0;
        $diff = 0;
        $hig = 0;
        foreach ($exports as $export){
            $hig+= max(0,$export->payed-$export->suma);
            $summa+=$export->suma;
            $coma+=$export->coma;
            $payed+=$export->payed;
            $diff+=max(0,$export->suma-$export->payed);
        }
        return view('pages.stats',compact('summa','coma','payed','diff','hig'));
    }
}
