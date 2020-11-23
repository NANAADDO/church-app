<?php
/**
 * Created by PhpStorm.
 * User: APPUSER3
 * Date: 10/8/2018
 * Time: 11:49 PM
 */

namespace App\Traits;


use App\Helpers\ProcessFunctions;
use App\Helpers\Report;
use App\Models\Membercustompayment;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;
use Webpatser\Uuid\Uuid;

use Illuminate\Http\Request;
trait GeneralReportTrait
{
    use GeneralProcessTrait;
    use ReportDBTrait;

    public function reportLogic(Request $request, $collectionID, $tempTableName,$colType){
    $this->createTempTable($tempTableName);
    return $this->reportLogicProcessor($request, $collectionID, $tempTableName,$colType);

    }

    public function reportLogicYearly(Request $request, $collectionID, $tempTableName,$colType){
        $this->createTempTable($tempTableName);
        return $this->reportLogicYearlyProcessor($request, $collectionID, $tempTableName,$colType);

    }

    public function reportLogicProcessor($request, $collectionID, $tempTableName,$colType)
    {
        $memberSelectConditon = false;
        $p_date = '';
        $pyears = '';
        //$myear=2017;
        $fetch_type = $request->fetch_type;
        //$eyear = 2020;
        $month_period = '';
        $start_month = $request->start_month;
        $end_month = $request->end_month;
        $year_select = false;
        $member_id = $request->member_id;
        //='53_2018-05-01_2_2018-02-04';
        $year_paid = $request->year_paid;
        $end_year = $request->end_year;
        $is_single_year_range = false;
        $m_state = false;
        $eyear = '';
        if ($member_id != null) {
            $sd = $this->explodearray('_', $member_id);
            $myr = $this->convert_date_to_year($sd[1]);
            $meid = $sd[0];
            $date_join = $sd[1];
            $memberID = " and p.member_id={$meid}";
            $memberSelectConditon = "id={$meid}";

        }

        if ($member_id != null && $year_paid == null) {
            $member_id = $meid;
            $myear = $myr;
            //$eyear = $this->currentyear();

        }
        if ($member_id != null && $year_paid != null) {
            $member_id = $meid;
            $myear = $year_paid;
            $eyear = $myear;

        }

        if ($year_paid != null) {
            $myear = $year_paid;
            $pyears = " and p.year={$myear}";
            $year_select = "date_joined <='{$myear}-12-31'";
            $eyear = $myear;
        }
        if ($year_paid != null && $end_year != null) {
            $eyear = $end_year;

            $year_select = "(date_joined  <= '{$myear}-01-01' or date_joined <='{$eyear}-12-31')";
        }

        if ($start_month != null && $end_month != null) {
            $month_period = " where m.ident between '{$start_month}' and '{$end_month }' ";
            $m_state = true;
        }

        if ($start_month != null && $end_month == null) {
            $month_period = " where m.ident between '{$start_month}' and '{$start_month }' ";
            $m_state = true;
            $end_month = $start_month;
        }

        $clause = '';
        $tempname = $tempTableName . $this->getuserid();
        $arr = [];
        $holdeyear=$eyear;

        $member_search_param = ($memberSelectConditon == false ? ($year_select == false ? '' : 'where ' . $year_select) : ($year_select == false ? 'where ' : 'where ') . $memberSelectConditon);

        $sql_select_members = DB::select($this->fetchMemberDataQuery(). $member_search_param);
        foreach ($sql_select_members as $member) {
            $memberDateJoined=($collectionID==5?$member->date_joined_welfare:$member->date_joined);
            $myear = $this->convert_date_to_year($memberDateJoined);
            if($member->status_id==config('relatedvariables.ch_config.memberdeceased')) {
                $deceasedYear = $this->convert_date_to_year($member->date_died);
                $deceasedDate = $member->date_died;

                if( $holdeyear > $deceasedYear){
                    $eyear = $deceasedYear;

                }
                else{
                    $eyear=$holdeyear;
                }
            }

            if ($year_paid != null && $end_year == null) {
                if ($myear < $year_paid) {
                    $myear = $year_paid;
                    $is_single_year_range = true;
                }
            }

            if ($year_paid != null && $end_year != null) {
                if ($myear <= $year_paid) {
                    $myear = $year_paid;
                    $is_single_year_range = true;
                }

                if ($myear > $year_paid) {
                    $myear = $myear;
                    $is_single_year_range = true;
                }

            }

            ($myear <= config('relatedvariables.ch_config.start_year') ? $syear = config('relatedvariables.ch_config.start_year') : $syear = $myear);

            for ($j = $syear; $j <= $eyear; $j++) {

                if ($is_single_year_range) {
                    $myear = $this->convert_date_to_year($memberDateJoined);

                }

                if ($myear == $j) {
                    $splitdate = $this->explodearray('-', $memberDateJoined);
                    $clause = ProcessFunctions::get_month_to_joined_church_to_start_contribution($splitdate[1], $splitdate[2]);
                } else {
                    $clause = 0;
                }
                /*
                if($member->status_id==config('relatedvariables.ch_config.memberdeceased')){
                    if ($deceasedYear == $j) {
                        $splitdate = $this->explodearray('-', $deceasedDate);
                        $clause = ProcessFunctions::get_month_to_joined_church_to_start_contribution($splitdate[1], $splitdate[2]);
                    } else {
                        $clause = 0;
                    }
                }
*/

                if ($month_period != null) {

                    if ($clause > 0 && $clause <= $end_month) {
                        $clause = ($start_month > $clause ? $start_month : $clause);
                        $month_period = " where m.ident >='{$clause}' and  m.ident <='{$end_month }' ";
                        //dd($month_period);

                    } else if ($clause > 0 && $clause > $end_month) {
                        $month_period = " where m.ident between '15' and '15' ";
                    } else {

                        $month_period = " where m.ident between '{$start_month}' and '{$end_month }' ";
                    }

                } else {
                    if ($clause > 0) {
                        $month_period = "where m.ident >= {$clause}";
                    } else {
                        $month_period = '';

                    }
                }
                if ($fetch_type == 4) {
                    $year_range = $year_paid . '-' . $end_year;
                } else {
                    $year_range = ' ';

                }

                $collectionColumn= ($colType ==0?'FIND_IN_SET (p.collection_id,?)':'p.collection_id=?');

                  if($collectionID==2){
                      if(Membercustompayment::where('collection_id',2)->where('member_id',$member->id)->where('year',$j)->count() >0){

                          $collectionID=2;
                      }
                      else{
                          $collectionID=4;
                      }
                  }

                $fetch = "INSERT INTO " . $tempname . "(collectionID,oldID,name,colname,ryearrange,member_id,mname,tpaid,date_paid,ryear,monthID)
            select '$collectionID','$member->old_member_id','$member->name',t1.colname,'$year_range',IFNULL(t1.new_member_id, '$member->new_member_id')as member_id,t1.mname,
                  sum(IFNULL(t1.amount_paid,0)) as tpaid ,max(IFNULL(t1.date_paid,null)) as date_paid, IFNULL(t1.year,'$j') as ryear,t1.ident
 from ((select pa.new_member_id,cg.name as colname,m.ident,m.name as mname,p.date_paid,p.amount_paid, p.year from months m LEFT JOIN payment_histories p on m.ident = p.month_paid 
   and ".$collectionColumn."  and p.year = ? and p.member_id=? and p.payment_state=? inner join churchgivens cg on ? = cg.id inner join memberdetails pa  on pa.id = ?   " . $month_period . "
      
  ) as t1) group by t1.ident,t1.new_member_id,t1.year ";
                //dd($fetch);
                DB::select($fetch, [$collectionID, $j, $member->id, 0, $collectionID,$member->id]);
                if ($m_state == false) {
                    $month_period = '';
                }
            }

            $eyear = $holdeyear;

        }
        if ($fetch_type != null) {

            $data = Report::filterType($fetch_type, $tempname);
        } else {

            $data = DB::table($tempname)->orderBy(DB::RAW('ryear'), 'asc')->get();
        }

        return $data;
    }


    public function reportLogicYearlyProcessor(Request $request, $collectionID, $tempTableName,$colType)
    {
        $memberSelectConditon = false;
        $p_date = '';
        $pyears = '';
        //$myear=2017;
        $fetch_type = $request->fetch_type;
        //$eyear = 2019;
        $year_select = false;
        $member_id = $request->member_id;
        $year_paid = $request->year_paid;
        $end_year = $request->end_year;
        $is_single_year_range = false;
        $m_state = false;
        $eyear = '';
        if ($member_id != null) {
            $sd = $this->explodearray('_', $member_id);
            $myr = $this->convert_date_to_year($sd[1]);
            $meid = $sd[0];
            $date_join = $sd[1];
            $memberID = " and p.member_id={$meid}";
            $memberSelectConditon = "id={$meid}";

        }

        if ($member_id != null && $year_paid == null) {
            $member_id = $meid;
            $myear = $myr;


        }
        if ($member_id != null && $year_paid != null) {
            $member_id = $meid;
            $myear = $year_paid;
            $eyear = $myear;

        }

        if ($year_paid != null) {
            $myear = $year_paid;
            $pyears = " and p.year={$myear}";
            $year_select = "date_joined <='{$myear}-12-31'";
            $eyear = $myear;
        }
        if ($year_paid != null && $end_year != null) {
            $eyear = $end_year;

            $year_select = "(date_joined  <= '{$myear}-01-01' or date_joined <='{$eyear}-12-31')";
        }




        $clause = '';
        $tempname = $tempTableName . $this->getuserid();

        $arr = [];
        $holdeyear=$eyear;

        $member_search_param = ($memberSelectConditon == false ? ($year_select == false ? '' : 'where ' . $year_select) : ($year_select == false ? 'where ' : 'where ') . $memberSelectConditon);

        $sql_select_members = DB::select($this->fetchMemberDataQuery() . $member_search_param);

        foreach ($sql_select_members as $member) {
            $myear = $this->convert_date_to_year($member->date_joined);
            if($member->status_id==config('relatedvariables.ch_config.memberdeceased')) {
                $deceasedYear = $this->convert_date_to_year($member->date_died);
                $deceasedDate = $member->date_died;

                if( $holdeyear > $deceasedYear){
                    $eyear = $deceasedYear;

                }
                else{
                    $eyear=$holdeyear;
                }
            }

            if ($year_paid != null && $end_year == null) {
                if ($myear < $year_paid) {
                    $myear = $year_paid;
                    $is_single_year_range = true;
                }
            }

            if ($year_paid != null && $end_year != null) {
                if ($myear <= $year_paid) {
                    $myear = $year_paid;
                    $is_single_year_range = true;
                }

                if ($myear > $year_paid) {
                    $myear = $myear;
                    $is_single_year_range = true;
                }

            }

            ($myear <= config('relatedvariables.ch_config.start_year') ? $syear = config('relatedvariables.ch_config.start_year') : $syear = $myear);

            for ($j = $syear; $j <= $eyear; $j++) {

                if ($is_single_year_range) {
                    $myear = $this->convert_date_to_year($member->date_joined);

                }

                if ($myear == $j) {
                    $splitdate = $this->explodearray('-', $member->date_joined);
                    $clause = ProcessFunctions::get_month_to_joined_church_to_start_contribution($splitdate[1], $splitdate[2]);
                } else {
                    $clause = 0;
                }



                if ($fetch_type == 4) {
                    $year_range = $year_paid . '-' . $end_year;
                } else {
                    $year_range = ' ';

                }
                $collectionColumn= ($colType ==0?" FIND_IN_SET (p.collection_id,"."'$collectionID')":'p.collection_id=?');
                $c_collectionColumn= ($colType ==0?" FIND_IN_SET (c.collection_id,"."'$collectionID')":'c.collection_id=?');

                $fetch = "INSERT INTO " . $tempname . "(collectionID,oldID,name,colname,ryearrange,member_id,tamount,tpaid,tbal,date_paid,ryear)
            select '$collectionID','$member->old_member_id','$member->name',t1.colname,'$year_range',IFNULL(t1.new_member_id, '$member->new_member_id') as member_id,t1.amount,
                  sum(IFNULL(t1.amount_paid,0)) as tpaid ,t1.amount - sum(IFNULL(t1.amount_paid,0)) as tbal, max(IFNULL(t1.date_paid,null)) as date_paid,t1.year as ryear
 from ((
            select c.amount,c.year,pa.new_member_id,cg.name as colname,p.date_paid,p.amount_paid  from churchcustompayments c LEFT JOIN 
            payment_histories p on c.id = p.point_sub_id and ".$collectionColumn."  and 
            p.payment_state=? and p.year = ? and p.member_id=? 
             inner join churchgivens cg on c.collection_id = cg.id inner join memberdetails pa  on   pa.id = ?
    where ".$c_collectionColumn."  
   and  c.year=? 
   ) as t1) group by t1.new_member_id,t1.year ";

               DB::select($fetch, [$collectionID,0,$j,$member->id,$member->id,$collectionID,$j]);

            }
            $eyear=$holdeyear;

        }
        if ($fetch_type != null) {

            $data = Report::filterTypeBasedOnColumn($collectionID,$fetch_type, $tempname);
        } else {

            $data = DB::table($tempname)->orderBy(DB::RAW('ryear'), 'asc')->get();

        }

        return $data;
    }


    public function reportLogicTransportProcessor(Request $request, $collectionID, $tempTableName){



        $memberSelectConditon = false;
        $fetch_type = $request->fetch_type;
        $year_select = false;
        $member_id = $request->member_id;
        $year_paid = $request->year_paid;
        $end_year = $request->end_year;
        if ($member_id != null) {
            $sd = $this->explodearray('_', $member_id);
            $myr = $this->convert_date_to_year($sd[1]);
            $meid = $sd[0];
            $member_id = $meid;
            $memberSelectConditon = "id={$meid}";

        }




        if ($year_paid != null) {
            $myear = $year_paid;
            $year_select = "date_joined <='{$myear}-12-31'";
        }
        if ($year_paid != null && $end_year != null) {
            $eyear = $end_year;
            $year_select = "(date_joined  <= '{$myear}-01-01' or date_joined <='{$eyear}-12-31')";
        }


        $tranport_s = 'and t.txt_state_id = 2';
    if ($member_id != null){
        $member_c = "where id = '$member_id'";
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
    else{

    }

    if ($request->start_date != null) {
        $p_history_s = " and  p.date_paid between '{$request->start_date}' and '{$request->end_date }' ";
    }
    $tempname=$tempTableName.$this->getuserid();

        $member_search_param = ($memberSelectConditon == false ? ($year_select == false ? '' : 'where ' . $year_select) : ($year_select == false ? 'where ' : 'where ') . $memberSelectConditon);
        $db = DB::select($this->fetchMemberDataQuery() . $member_search_param);


        foreach ($db as $row){

            if($row->status_id==config('relatedvariables.ch_config.memberdeceased')){
                $deceasedYear = $this->convert_date_to_year($row->date_died);
                $deceasedDate = $row->date_died;
                if ($year_paid != null && $end_year == null) {
                    if($deceasedYear <= $year_paid ){
                        $year_select = " and t.date  between '$row->date_joined}' and  '{$deceasedDate}'";
                    }
                    else {
                        $year_select = "  and t.date  between '$row->date_joined}' and  '{$year_paid}-12-31'";
                    }
                }
                if ($year_paid != null && $end_year != null) {
                    if($deceasedYear <= $end_year ){
                        $year_select = " and t.date  between '{$row->date_joined}' and  '{$deceasedDate}'";

                    }
                    else {
                        $year_select = " and t.date  between '{$row->date_joined}' and  '{$end_year}-12-31'";

                    }

                }

            }
            else {
                if ($year_paid != null && $end_year == null) {
                    $year_select = " and t.date  between '$row->date_joined}' and  '{$year_paid}-12-31'";
                }
                if ($year_paid != null && $end_year != null) {
                    $year_select = " and t.date  between '{$row->date_joined}' and  '{$end_year}-12-31'";
                }

            }

        $unirec="INSERT INTO ".$tempname."(colname,collectionID,oldID,member_id,tamount,name,transid,tpaid,date_paid,descrip,tbal,ryear)
 select t1.name,'$collectionID','$row->old_member_id','$row->new_member_id' as pmid,t1.amount,'$row->name' as rname ,t1.trans_id,sum(IFNULL(t2.amount_paid,0)) as totalpaid,
max(t2.date_paid) as date_paid,t1.description, t1.amount - sum(IFNULL(t2.amount_paid,0)) as bal,t1.date  from ((select year(t.date) as date,t.amount,t.id as trans_id,t.member_id,t.description, cg.name from transports t  inner join churchgivens cg on cg.id =?
where  t.member_id !='$row->id' " .$year_select. " " .$tranport_s. " ) as t1 left join
(select  p.amount_paid,p.date_paid,p.point_sub_id,IFNULL(p.member_id,'$row->id') as memid from 
 payment_histories p   where p.member_id=? and p.collection_id=? and p.payment_state=? ) as t2 on t1.trans_id=t2.point_sub_id )  group by t1.trans_id,t2.memid";
        DB::select($unirec,[$collectionID,$row->id,$collectionID,0]);

    }

        $data = DB::table($tempname)->get();

        return $data;
}


}
