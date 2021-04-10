<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Report;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment_history;
use App\Models\Welfaredetailreport;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;


class WelfaredetailreportController extends General
{
    protected $model = payment_history::class;
    protected $viewname = 'welfaredetailreport';
    protected $path_custom = 'admin/';
    protected $view_custom = 'admin.';
    protected $searchparms = "";
    protected $Rolelevel;
    protected $roleaccess;
    protected $LogGeneral;
    protected $vali;
    protected $validationRules = [
        'message_id' => 'required',
        'tag_id' => 'required'];
    protected $imgtostaff;
    protected $imgtoIDType;
    protected $validoptional = [];

    protected $welfare = 5;
    protected $welfareLevy = 6;

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $fetch = "select t1.name,t1.new_member_id,t1.mname,
                   sum(IFNULL(t1.amount_paid,0)) as amp ,max(t1.date_paid) as dpaid,t1.year as ryear
 from ((select pa.new_member_id,CONCAT( pa.surname, ' ', pa.other_names) as name,p.date_paid,m.ident,m.name as mname,p.amount_paid, p.year,p.member_id,p.month_paid from payment_histories p join months m on p.month_paid  = m.ident  
 and p.collection_id=?   and p.payment_state=? join memberdetails pa  on p.member_id= pa.id) as t1) group by t1.ident,t1.member_id,t1.year";
        $data = DB::select($fetch, [$this->welfare, 0]);


        return view('admin.welfaredetailreport.index', compact('data'));
    }




    public function store(Request $request)
    {


        $tableName='welfare';
        $col_type = $request->type;
        if($col_type==$this->welfareLevy){

            $data=  $this->reportLogicYearly($request,$this->welfareLevy,$tableName,1);
        }
        else if($col_type==$this->welfare)
        {

            $data=$this->reportLogic($request,$this->welfare,$tableName,1);
        }

        // dd($data);
        return DataTables::of($data)->make(true);




    }




    }
