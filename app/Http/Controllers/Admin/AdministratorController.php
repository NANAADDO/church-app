<?php

namespace App\Http\Controllers\Admin;

use App\Churchgiven;
use App\Helpers\Given;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Othercollection;
use App\Models\payment_history;
use App\Traits\PaymentHistoryTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

class AdministratorController extends General
{


    public function admin_payment_summary(Request $request)
    {


            $date = $request->dated;
            $permdash = \App\Helpers\Menu::get_all_sub_menu_permission();

        return view('includes.dash')->with(compact('date', 'permdash'))->render();


    }




    }
