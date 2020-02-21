<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Given;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\othercollectiondetailreport;
use App\Models\payment_history;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;

class othercollectiondetailreportController extends General
{
   protected $model = payment_history::class;
      protected $viewname = 'othercollectiondetailreport';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
       $values = $this->implodearray(Given::get_church_given_based_on_group(5));

        $fetch =  "select t1.name,t1.new_member_id,t1.amount,t1.colname,t1.collection_id,
                  sum(IFNULL(t1.amount_paid,0)) as tpaid ,t1.amount - sum(IFNULL(t1.amount_paid,0)) as tbal, max(IFNULL(t1.date_paid,null)) as date_paid,t1.year as ryear
 from ((select cg.name as colname,c.collection_id,c.amount,c.year,pa.new_member_id,CONCAT( pa.surname, ' ', pa.other_names) as name,p.date_paid,p.amount_paid from  churchcustompayments c LEFT JOIN payment_histories p on c.id = p.point_sub_id 
   and p.payment_state=? inner join churchgivens cg on c.collection_id = cg.id    inner join memberdetails pa  on p.member_id = pa.id where FIND_IN_SET(c.collection_id,?)
) as t1) group by t1.new_member_id,t1.year,t1.colname";
                $data = DB::select($fetch, [0,$values]);


        return view('admin.othercollectiondetailreport.index', compact('data'));
    }



    }
