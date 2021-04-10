<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment_history;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class DailycollectionreportController extends General
{
   protected $model = payment_history::class;
      protected $viewname = 'dailycollectionreport';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;

       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {

        $sql = "select CONCAT( m.surname, ' ', m.other_names) name,m.new_member_id,m.old_member_id, p.amount_paid as amount,c.name as coltype,p.date_paid as dpaid from  memberdetails  m join payment_histories p
             on m.id = p.member_id join churchgivens c on p.collection_id = c.id where p.payment_state =? limit 0,100 ";

        $data= DB::select($sql,[0]);

        return view('admin.dailycollectionreport.index', compact('data'));
    }

    public function store(Request $request)
    {

    $whereArray = array();
    $pDate=$request->payment_date;
    $colType=$request->col_type;

        $baseQuery = "select CONCAT( m.surname, ' ', m.other_names) name,m.new_member_id,m.old_member_id, p.amount_paid as amount,c.name as coltype,p.date_paid as dpaid from  memberdetails  m join payment_histories p
             on m.id = p.member_id join churchgivens c on p.collection_id = c.id  ";
        if ($pDate!= null)
            $whereArray[] = " p.date_paid='{$pDate}'";
        if ($colType!= null)
            $whereArray[] = " p.collection_id={$colType}";
        $whereClause= implode(" and ", $whereArray);
        $finalbaseQuery=$baseQuery." where p.payment_state =? ";
        if ($whereClause!=null){
            $finalbaseQuery=$baseQuery." where p.payment_state =?  and ".$whereClause;
        }
        $data= DB::select($finalbaseQuery,[0]);
        return DataTables::of($data)->make(true);
    }


    }
