<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\payment_history;
use App\Models\Transportdetailreport;
use App\Traits\PaymentHistoryTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TransportdetailreportController extends General
{
   protected $model = payment_history::class;
      protected $viewname = 'transportdetailreport';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;

       protected $validationRules = [
			'country_id' => 'required',
			'region_id' => 'required',
			'location' => 'required',
			'address' => 'required',
			'phone_numbers' => 'required'];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        $tempname='transportsearched'.$this->getuserid();

        $table = "CREATE TEMPORARY TABLE IF NOT EXISTS ".$tempname." (descrip varchar(1000),rname varchar(100),transid integer ,amount  decimal(18,2),tpaid  decimal(18,2), rmember_id varchar(100),date_paid date)";


        $sql = "select CONCAT( surname, ' ', other_names) rname, date_joined,id as memid,new_member_id from  memberdetails ";

        $db = DB::select($sql);
        $sqltrunc = "TRUNCATE TABLE ".$tempname;
        DB::statement($table);
        DB::statement($sqltrunc);
        $arr=[];
        foreach ($db as $row){

            $unirec="INSERT INTO ".$tempname."(rmember_id,amount,rname,transid,tpaid,date_paid,descrip)
 select '$row->new_member_id' as pmid,t1.amount,'$row->rname' as rname ,t1.trans_id,sum(IFNULL(t2.amount_paid,0)) as totalpaid,
max(t2.date_paid) as date_paid,t1.description  from ((select t.amount,t.id as trans_id,t.member_id,t.description from transports t  
where t.date >='$row->date_joined' and t.txt_state_id = 2 ) as t1 left join
(select  p.amount_paid,p.date_paid,p.point_sub_id,IFNULL(p.member_id,'$row->memid') as memid from 
 payment_histories p  where p.member_id='$row->memid' and p.collection_id=3 and p.payment_state=0) as t2 on t1.trans_id=t2.point_sub_id )  group by t1.trans_id,t2.memid";
            DB::select($unirec);

        }


        $data = DB::table($tempname)->get();

        return view('admin.'.$this->viewname.'.index', compact('data'));


    }

    public function store(Request $request)
    {
        if (\Request::ajax()) {
            $member_c = '';
            $p_history_s ='';
            $tranport_s = 'and t.txt_state_id = 2';
            if ($request->member_id != null){
                $member_c = "where id = '$request->member_id'";
            }
            $whereArray = array();
            if ($request->status != null)
                $whereArray[] = " t.txt_state_id = {$request->status}";

            if ($request->funeral_person != null)
                $whereArray[] = " t.id ={$request->funeral_person}";

            $whereClause= implode(" and ", $whereArray);
            if ($whereClause!=null){
               $tranport_s = " and  ".$whereClause;
            }

            if ($request->start_date != null) {
                $p_history_s = " and  p.date_paid between '{$request->start_date}' and '{$request->end_date }' ";
            }
            $tempname='transportsearched'.$this->getuserid();

            $table = "CREATE TEMPORARY TABLE IF NOT EXISTS ".$tempname." (descrip varchar(1000),rname varchar(100),transid integer ,amount  decimal(18,2),bal  decimal(18,2),tpaid  decimal(18,2), rmember_id varchar(100),date_paid date)";


            $sql = "select CONCAT( surname, ' ', other_names) rname, date_joined,id as memid,new_member_id from  memberdetails ".$member_c ;

            $db = DB::select($sql);
            $sqltrunc = "TRUNCATE TABLE ".$tempname;
            DB::statement($table);
            DB::statement($sqltrunc);
            $arr=[];
            foreach ($db as $row){

                $unirec="INSERT INTO ".$tempname."(rmember_id,amount,rname,transid,tpaid,date_paid,descrip,bal)
 select '$row->new_member_id' as pmid,t1.amount,'$row->rname' as rname ,t1.trans_id,sum(IFNULL(t2.amount_paid,0)) as totalpaid,
max(t2.date_paid) as date_paid,t1.description, t1.amount - sum(IFNULL(t2.amount_paid,0)) as bal  from ((select t.amount,t.id as trans_id,t.member_id,t.description from transports t  
where t.date >='$row->date_joined' ".$tranport_s. " ) as t1 left join
(select  p.amount_paid,p.date_paid,p.point_sub_id,IFNULL(p.member_id,'$row->memid') as memid from 
 payment_histories p  where p.member_id='$row->memid' and p.collection_id=3 and p.payment_state=0  " .$p_history_s. " ) as t2 on t1.trans_id=t2.point_sub_id )  group by t1.trans_id,t2.memid";
                DB::select($unirec);

            }

            if($request->fetch_type ==1) {

                $data = DB::table($tempname)->where('bal','=',0)->get();
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
    }


}
