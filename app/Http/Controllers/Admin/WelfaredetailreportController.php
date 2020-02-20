<?php

namespace App\Http\Controllers\Admin;

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
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [
			'message_id' => 'required',
			'tag_id' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];

       protected $welfare = 5;
    protected $welfareLevy = 6;

    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $fetch =  "select t1.name,t1.new_member_id,t1.mname,
                   sum(IFNULL(t1.amount_paid,0)) as amp ,max(t1.date_paid) as dpaid,t1.year as ryear
 from ((select pa.new_member_id,CONCAT( pa.surname, ' ', pa.other_names) as name,p.date_paid,m.ident,m.name as mname,p.amount_paid, p.year,p.member_id,p.month_paid from payment_histories p join months m on p.month_paid  = m.ident  
 and p.collection_id=?   and p.payment_state=? join memberdetails pa  on p.member_id= pa.id) as t1) group by t1.ident,t1.member_id,t1.year";
        $data =  DB::select($fetch,[$this->welfare,0]);


        return view('admin.welfaredetailreport.index', compact('data'));
    }

    public function store(Request $request)
    {
        $memberID ='';
        $perPage = 25;

        $p_date = '';
        $pyears = '';
        $genyear = '';
        $col_type = $request->type;
        $year_paid = $request->year_paid;
        if($request->member_id !=null){
            $sd = $this->explodearray('_',$request->member_id);
            $myr = $this->convert_date_to_year($sd[1]);
            $meid = $sd[0];
            $date_join = $sd[1];
            $memberID = " and p.member_id={$meid}";
        }

        if($year_paid !=null){
            $genyear = " and c.year={$year_paid}";
        }

        if($request->member_id !=null && $request->year_paid ==null) {
            $member_id = $meid;
            $myear = $myr;
            $eyear = $this->currentyear();
        }
        if($request->member_id !=null && $request->year_paid !=null) {
            $member_id =$meid;
            $myear = $request->year_paid;
            $eyear = $myear;
        }

        if($request->year_paid !=null){
            $myear = $request->year_paid;
            $pyears = " and p.year={$myear}";

        }

        if ($request->start_date != null) {
            $p_date = "and  p.date_paid between '{$request->start_date}' and '{$request->end_date }' ";
        }


        $clause='';
        $tempname='welfarereport'.$this->getuserid();

        $table = "CREATE TEMPORARY TABLE IF NOT EXISTS ".$tempname."(mname varchar(10), name varchar(100),ryear year
        ,tpaid  decimal(18,2),tamount  decimal(18,2),tbal  decimal(18,2),member_id varchar(100) ,date_paid date)";



        $sqltrunc = "TRUNCATE TABLE ".$tempname;
        DB::statement($table);
        DB::statement($sqltrunc);
        $arr=[];




        if($request->member_id !=null && $col_type != null) {
            ($myear <= config('relatedvariables.ch_config.start_year') ? $syear = config('relatedvariables.ch_config.start_year') : $syear = $myear);
            for ($j = $syear; $j <= $eyear; $j++) {
                if ($col_type == $this->welfare) {


                    $fetch = "INSERT INTO " . $tempname . "(name,member_id,mname,tpaid,date_paid,ryear)
            select t1.name,t1.new_member_id as member_id,t1.mname,
                  sum(IFNULL(t1.amount_paid,0)) as tpaid ,max(IFNULL(t1.date_paid,null)) as date_paid, IFNULL(t1.year,'$j') as ryear
 from ((select pa.new_member_id,CONCAT( pa.surname, ' ', pa.other_names) as name,m.ident,m.name as mname,p.date_paid,p.amount_paid, p.year from months m LEFT JOIN payment_histories p on m.ident = p.month_paid 
   and p.collection_id=?   and p.payment_state=? and p.year = ? " . $memberID . " inner join memberdetails pa  on '$meid' = pa.id " . $p_date . "   
  ) as t1) group by t1.ident,t1.new_member_id,t1.year ";
                    DB::select($fetch, [$this->welfare, 0, $j]);

                }
                else {

                    $fetch = "INSERT INTO " . $tempname . "(name,member_id,tamount,tpaid,tbal,date_paid,ryear)
            select t1.name,t1.new_member_id as member_id,t1.amount,
                  sum(IFNULL(t1.amount_paid,0)) as tpaid ,t1.amount - sum(IFNULL(t1.amount_paid,0)) as tbal, max(IFNULL(t1.date_paid,null)) as date_paid, IFNULL(t1.year,'$j') as ryear
 from ((select c.amount,c.year,pa.new_member_id,CONCAT( pa.surname, ' ', pa.other_names) as name,p.date_paid,p.amount_paid from  churchcustompayments c LEFT JOIN payment_histories p on c.id = p.point_sub_id 
   and p.collection_id=?  and p.payment_state=?" . $memberID . " inner join memberdetails pa  on '$meid' = pa.id where c.collection_id = ?  
    and c.year = ? " . $p_date . "   
  ) as t1) group by t1.new_member_id,t1.year ";
                    DB::select($fetch, [$this->welfareLevy, 0,$this->welfareLevy,$j]);
                    }
                }
            if ($request->fetch_type != null) {
                if ($request->fetch_type == 1) {
                    $data = DB::table($tempname)->where('tpaid', '<=', 0)->get();
                }
                else {

                    $data = DB::table($tempname)->where('tpaid', '>', 0)->get();
                }
            }
            else {


            }
        }

        else{

            if ($col_type != $this->welfare) {
                $fetch = "INSERT INTO " . $tempname . "(name,member_id,tamount,tpaid,tbal,date_paid,ryear)
            select t1.name,t1.new_member_id as member_id,t1.amount,
                  sum(IFNULL(t1.amount_paid,0)) as tpaid ,t1.amount - sum(IFNULL(t1.amount_paid,0)) as tbal, max(IFNULL(t1.date_paid,null)) as date_paid,t1.year as ryear
 from ((select c.amount,c.year,pa.new_member_id,CONCAT( pa.surname, ' ', pa.other_names) as name,p.date_paid,p.amount_paid from  churchcustompayments c LEFT JOIN payment_histories p on c.id = p.point_sub_id 
   and p.collection_id=?  and p.payment_state=?" . $memberID . " inner join memberdetails pa  on p.member_id = pa.id where c.collection_id = ?  
    " .$genyear. " " . $p_date . "   
  ) as t1) group by t1.new_member_id,t1.year ";
                DB::select($fetch, [$this->welfareLevy, 0,$this->welfareLevy]);
                $data = DB::table($tempname)->orderBy(DB::RAW('ryear'), 'asc')->get();
            }
            else{
                $fetch = "select t1.name,t1.new_member_id as member_id,t1.mname,
                   sum(IFNULL(t1.amount_paid,0)) as tpaid ,max(t1.date_paid) as date_paid,t1.year as ryear
 from ((select pa.new_member_id,CONCAT( pa.surname, ' ', pa.other_names) as name,p.date_paid,m.ident,m.name as mname,p.amount_paid, p.year,p.member_id,p.month_paid from payment_histories p join months m on p.month_paid  = m.ident  
 and p.collection_id=?   and p.payment_state=0 " . $pyears . " inner join memberdetails pa  on p.member_id = pa.id " . $memberID . "  " . $p_date . ") as t1) group by t1.ident,t1.member_id,t1.year";
                $data = DB::select($fetch, [$this->welfare]);
            }
            }

        return DataTables::of($data)->make(true);

    }


    }
