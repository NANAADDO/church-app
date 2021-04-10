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
use Yajra\DataTables\DataTables;

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
   and p.payment_state=? inner join churchgivens cg on c.collection_id = cg.id  inner join memberdetails pa  on p.member_id = pa.id where FIND_IN_SET(c.collection_id,?)
) as t1) group by t1.new_member_id,t1.year,t1.colname";
                $data = DB::select($fetch, [0,$values]);


        return view('admin.othercollectiondetailreport.index', compact('data'));
    }




    public function store(Request $request)
    {
        /*
        if (\Request::ajax()) {
            $eyear = $this->currentyear();
            $ids = $this->implodearray(Given::get_church_given_based_on_group(5));
            $member_c = '';
            $p_history_s ='';
            $others_s = '';

            if ($request->member_id != null){
                $member_c = "where id = '$request->member_id'";
            }
            $whereArray = array();
            if ($request->type != null) {
                $whereArray[] = " c.collection_id ={$request->type}";
                $colset = $request->type;
            }
            else{
                $whereArray[] = " FIND_IN_SET (c.collection_id,"."'".$ids."')";
                $colset = $ids;
            }
            $whereClause= implode(" and ", $whereArray);
            if ($whereClause!=null){
                $others_s = " and ".$whereClause;
            }

            if ($request->start_date != null) {
                $whereArray[]  = " and  p.date_paid between '{$request->start_date}' and '{$request->end_date }' ";
            }
            $tempname='transportreport'.$this->getuserid();

            $table = "CREATE TEMPORARY TABLE IF NOT EXISTS ".$tempname."(colname varchar(100), name varchar(100),ryear year
        ,tpaid  decimal(18,2),tamount  decimal(18,2),tbal  decimal(18,2),new_member_id varchar(100) ,date_paid date)";

            $sql = "select CONCAT( surname, ' ', other_names) rname,id, date_joined,id as memid,new_member_id from  memberdetails ".$member_c ;

            $db = DB::select($sql);
            $sqltrunc = "TRUNCATE TABLE ".$tempname;
            DB::statement($table);
            DB::statement($sqltrunc);
            $arr=[];
            foreach ($db as $row) {

                if ($request->year_paid != null) {
                    $myr = $request->year_paid;
                    $eyear= $request->year_paid;
                } else {
                    $myr = $myr = $this->convert_date_to_year($row->date_joined);

                }
                ($myr <= config('relatedvariables.ch_config.start_year') ? $syear = config('relatedvariables.ch_config.start_year') : $syear = $myr);
                for ($j = $syear; $j <= $eyear; $j++) {


                    $unirec = "INSERT INTO " . $tempname . "(new_member_id,tamount,tpaid,name,date_paid,tbal,ryear,colname)
 select t1.new_member_id,t1.amount,sum(IFNULL(t1.amount_paid,0)) as totalpaid, '$row->rname' as rname,
max(t1.date_paid) as date_paid, t1.amount - sum(IFNULL(t1.amount_paid,0)) as bal,t1.year,t1.colname  from ((select pa.new_member_id,cg.name as colname,c.collection_id,c.amount,c.year,p.date_paid,p.amount_paid from  churchcustompayments c LEFT JOIN payment_histories p on c.id = p.point_sub_id
   and p.payment_state=? and p.year = ? and p.member_id = ? and FIND_IN_SET (p.collection_id,?) inner join memberdetails pa  on ? = pa.id inner join churchgivens cg on c.collection_id = cg.id where c.year = ? " . $others_s . "
) as t1) group by t1.colname,t1.new_member_id,t1.year";
                    DB::select($unirec, [0,$j,$row->id,$colset, $row->id,$j]);

                }

            }

            if($request->fetch_type ==1) {

                $data = DB::table($tempname)->where('tbal','=',0)->get();
            }
            else if($request->fetch_type ==2) {
                $data = DB::table($tempname)->where('tpaid','>',0)->get();
            }
            else if($request->fetch_type ==3) {
                $data = DB::table($tempname)->where('tpaid','=',0)->get();
            }

            else{
                $data = DB::table($tempname)->get();
            }
            return DataTables::of($data)->make(true);

        }

        */

        $tableName='othercollection';

        $data=  $this->reportLogicYearly($request, $request->type,$tableName,1);
        return DataTables::of($data)->make(true);
    }


}
