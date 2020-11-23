<?php
//app/Helpers/User.php
namespace App\Helpers;
use http\Env\Request;
use Illuminate\Support\Facades\DB;
Use App\Traits\GeneralProcessTrait;

class Report
{

use GeneralProcessTrait;
    public static function filterType($fetch_type,$tempname)
    {
        $data = [];

            if ($fetch_type == 1) {
                $data = DB::table($tempname)->where('tpaid', '<=', 0)->get();
            }
            else  if ($fetch_type == 2){


                $data = DB::table($tempname)->where('tpaid', '>', 0)->get();
            }
            /*
             *  $data = DB::select("SELECT distinct(s.name) as name, oldID,m.ryear,m.member_id,m.totalmonth,m.totalpaid,m.totalpaidmonth
              FROM ".$tempname." s join (select ryear, member_id,count(ryear) as totalmonth,
                count(CASE WHEN tpaid  > 0 THEN 1 END) AS totalpaidmonth,
                     SUM(CASE WHEN tpaid > 0 THEN tpaid  ELSE 0 END) AS totalpaid FROM ".$tempname." group by ryear, member_id) m  on
                     s.member_id=m.member_id");
             * */

            else if ($fetch_type == 3){

                $data = DB::select("SELECT distinct(s.name) as name, oldID,m.ryear,m.member_id,m.totalmonth,m.totalpaid,m.totalpaidmonth
              FROM ".$tempname." s join (select ryear, member_id,count(ryear) as totalmonth,
                count(CASE WHEN tpaid  > 0 THEN 1 END) AS totalpaidmonth,
                     SUM(CASE WHEN tpaid > 0 THEN tpaid  ELSE 0 END) AS totalpaid FROM ".$tempname." group by ryear, member_id) m  on
                     s.member_id=m.member_id");
                /*
                $data = DB::select("SELECT name,oldID,member_id,ryear,count(ryear) as totalmonth, count(CASE WHEN tpaid  > 0 THEN 1 END) AS totalpaidmonth, 
                     SUM(CASE WHEN tpaid > 0 THEN tpaid  ELSE 0 END) AS totalpaid FROM ".$tempname." group by ryear, member_id");

                */
            }

    else{
        $data = DB::select("SELECT distinct(s.name) as name, oldID,s.ryearrange as ryear,m.member_id,m.totalmonth,m.totalpaid,m.totalpaidmonth
              FROM ".$tempname." s join (select member_id,count(ryear) as totalmonth,
                count(CASE WHEN tpaid  > 0 THEN 1 END) AS totalpaidmonth,
                     SUM(CASE WHEN tpaid > 0 THEN tpaid  ELSE 0 END) AS totalpaid FROM ".$tempname." group by member_id) m  on
                     s.member_id=m.member_id");
/*
                $data = DB::select("SELECT name,member_id,oldID,ryearrange as ryear,count(ryear) as totalmonth, count(CASE WHEN tpaid  > 0 THEN 1 END) AS totalpaidmonth, 
                     SUM(CASE WHEN tpaid > 0 THEN tpaid  ELSE 0 END) AS totalpaid FROM ".$tempname." group by member_id");
*/
            }


        return $data;
    }



    public static function filterTypeBasedOnColumn($colType,$fetch_type,$tempname)
    {
        $data = [];

        if ($fetch_type == 1) {
            $data = DB::table($tempname)->where('tpaid', '<=', 0)->get();
        }
        else  if ($fetch_type == 2){


            $data = DB::table($tempname)->where('tpaid', '>', 0)->get();
        }
           else if ($fetch_type == 3){
     $data = DB::table($tempname)->orderBy(DB::RAW('ryear'), 'asc')->get();


        }

        else if ($fetch_type == 4) {

            $data = DB::select("SELECT distinct(s.name) name,m.tpaid,m.tamount,m.tbal,s.oldID,m.member_id,s.colname,s.ryearrange as ryear from  " . $tempname . "
             s join (select member_id, sum(tpaid) as tpaid ,sum(tamount) as tamount,sum(tbal) as tbal   FROM " . $tempname . " group by member_id)m on s.member_id=m.member_id");

            /*
                        $data = DB::select("SELECT name,oldID,member_id,colname,ryearrange as ryear,sum(tpaid) as tpaid ,sum(tamount) as tamount,sum(tbal)as tbal   FROM " . $tempname . " group by member_id");

                       */

        }
        else{
            $data=[];

        }


        return $data;
    }



}
