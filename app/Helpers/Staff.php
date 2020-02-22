<?php

namespace App\Helpers;
use App\Models\payment_history;
use App\Traits\GeneralProcessTrait;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralVariables;
class Staff {




    public static function get_total_staff() {
        $data = User::count();

        return $data;
    }

    public static function get_staff(){

      return  DB::table('users')->latest()->offset(0)->limit(10)->get();

    }




}
