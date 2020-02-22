<?php

namespace App\Helpers;
use App\Models\payment_history;
use App\Traits\GeneralProcessTrait;
use Illuminate\Support\Facades\DB;

class GeneralVariables {


    public static function currentdate(){
        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $tdate = $carbon_today->format('Y-m-d');

        return $tdate;
    }
    public static function currentdatecombined(){
        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $tdate = $carbon_today->format('Ymd');

        return $tdate;
    }

    public static  function currentyear(){
        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $tdate = $carbon_today->format('Y');

        return $tdate;
    }


    public static function getuserid()
    {

        return auth()->user()->id;
    }



public static function strpadvalue($total,$number)
{
   return  str_pad($total, $number, '0', STR_PAD_LEFT);

}
}
