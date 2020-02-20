<?php

namespace App\Helpers;
use App\Models\payment_history;
use App\Models\Transport;
use App\Traits\GeneralProcessTrait;
use App\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralVariables;
class Funeral {




    public static function get_total_staff() {
        $data = Transport::where('txt_state_id',2)->count();

        return $data;
    }

    public static function get_active_funeral(){

        return  Transport::where('txt_state_id',2)->latest()->offset(0)->limit(10)->get();

    }




}
