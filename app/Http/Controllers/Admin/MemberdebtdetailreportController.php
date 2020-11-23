<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Given;
use App\Helpers\ProcessFunctions;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\collectiongroup;
use App\Models\Memberdebtdetailreport;
use App\Models\Memberdetail;
use App\Models\payment_history;
use Illuminate\Http\Request;
use App\Http\Controllers\General;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;

class MemberdebtdetailreportController extends General
{
   protected $model = payment_history::class;
      protected $viewname = 'memberdebtdetailreport';
      protected $path_custom = 'admin/' ;
      protected $view_custom = 'admin.';
      protected $searchparms = "";
      protected $Rolelevel;
      protected $roleaccess;
      protected $LogGeneral;
       protected $vali;
       protected $validationRules = [];
       protected $imgtostaff ;
       protected $imgtoIDType;
       protected $validoptional = [];


    public function index(Request $request)
    {
        $data = [];

        return view('admin.memberdebtdetailreport.index', compact('data'));
    }


    public function store(Request $request)
    {
        $tableName='debtsearch';
        $data = [];
        $member_id= $request->member_id;
        if ($member_id != null) {
            $sd = $this->explodearray('_', $member_id);
            $meid = $sd[0];
           $doesMemberBelongToWelfare = Memberdetail::where([['id',$meid],['does_member_want_to_join_welfare',2]])->count();

        }
        $ids = $this->implodearray(Given::get_church_given_based_on_group(2));
        $collectionGroups =collectiongroup::select(['id'])->get();
    $this->createTempTable($tableName);
    $this->createFinalTempTable();

    foreach ($collectionGroups as $group){
        $groupID=$group->id;
        if(in_array($groupID,[1,4,2])){
            if($groupID==1){
                $this->reportLogicProcessor($request,2,$tableName,1);
                Foreach(Given::get_church_given_based_on_group($groupID) as $rowID) {

                    $this->BuildFinalReport(3, $rowID, $tableName);

                }
            }

    else if ($groupID == 2) {

        foreach (Given::get_church_given_based_on_group($groupID) as $rowID) {

            if ($rowID == 5) {
                if($doesMemberBelongToWelfare>0) {
                    $this->reportLogicProcessor($request, $rowID, $tableName, 1);
                    $this->BuildFinalReport(3, $rowID, $tableName);
                }
            } else {
               $this->reportLogicYearlyProcessor($request, $rowID, $tableName, 1);
                $this->BuildFinalReport(4, $rowID, $tableName);

            }

        }
    }
    else {

        foreach (Given::get_church_given_based_on_group($groupID) as $rowID) {

           $this->reportLogicProcessor($request, $rowID, $tableName, 1);

            $this->BuildFinalReport(3, $rowID, $tableName);
        }
}
        }
        else if(in_array($groupID,[5])){

            Foreach(Given::get_church_given_based_on_group($groupID) as $rowID){

               $this->reportLogicYearlyProcessor($request,$rowID,$tableName,1);
                $this->BuildFinalReport(4, $rowID, $tableName);
            }
        }
        else{

            foreach (Given::get_church_given_based_on_group($groupID) as $rowID) {
                $this->reportLogicTransportProcessor($request, $rowID, $tableName);
                $this->BuildFinalReport(0, $rowID, $tableName);
            }

        }

    }

    $data=DB::table('finalDebtReport'.$this->getuserid())->get();
    //dd($data);
        return DataTables::of($data)->make(true);
    }



    public function BuildFinalReport($fetch,$colID,$fetchTable){
        $tempname ='finalDebtReport'.$this->getuserid();
        $fetchTableTemp=$fetchTable. $this->getuserid();
        if ($fetch == 3){
            DB::select("INSERT INTO " . $tempname ."(name,member_id,ryear,colname,oldID,tmonth,tpaidmonth,tpaid)
SELECT distinct(m.name) name ,s.member_id,s.ryear,m.colname,m.oldID,s.totalmonth,s.totalpaidmonth,s.totalpaid from ".$fetchTableTemp." m join (select member_id,ryear,count(ryear) as totalmonth, count(CASE WHEN tpaid  > 0 THEN 1 END) AS totalpaidmonth, 
                     SUM(CASE WHEN tpaid > 0 THEN tpaid  ELSE 0 END) AS totalpaid FROM ".$fetchTableTemp." where collectionID=? group by ryear, member_id) s on m.member_id = s.member_id where m.collectionID=? and s.totalmonth!= s.totalpaidmonth",
                [$colID,$colID]);
            /*

            DB::select("INSERT INTO " . $tempname ."(name,member_id,ryear,colname,oldID,tmonth,tpaidmonth,tpaid)
SELECT name,member_id,ryear,colname,oldID,count(ryear) as totalmonth, count(CASE WHEN tpaid  > 0 THEN 1 END) AS totalpaidmonth,
                     SUM(CASE WHEN tpaid > 0 THEN tpaid  ELSE 0 END) AS totalpaid FROM ".$fetchTableTemp." where collectionID=? group by ryear, member_id",
            [$colID]);

            */

        }
        else if($fetch==4){
            DB::select("INSERT INTO " . $tempname ."(name,member_id,ryear,colname,oldID,tamount,tpaid,tbal,date_paid)
SELECT distinct(m.name) name,s.member_id,s.ryear,m.colname,m.oldID,m.tamount,m.tpaid,m.tbal,m.date_paid FROM ".$fetchTableTemp." m join( select member_id,ryear from ".$fetchTableTemp."  where collectionID=? group by ryear, member_id) s on m.member_id = s.member_id where 
 m.collectionID=? and m.tbal > 0",
                [$colID,$colID]);
            /*
            DB::select("INSERT INTO " . $tempname ."(name,member_id,ryear,colname,oldID,tamount,tpaid,tbal,date_paid)
SELECT name,member_id,ryear,colname,oldID,tamount,tpaid,tbal,date_paid FROM ".$fetchTableTemp." where collectionID=? group by ryear, member_id",
                [$colID]);

*/
        }
        else{
            DB::select("INSERT INTO " . $tempname ."(name,descrip,member_id,ryear,colname,oldID,tamount,tpaid,tbal,date_paid)
SELECT name,descrip,member_id,ryear,colname,oldID,tamount,tpaid,tbal,date_paid FROM ".$fetchTableTemp." where collectionID=? and tbal > 0",
                [$colID]);
        }
    }

}
