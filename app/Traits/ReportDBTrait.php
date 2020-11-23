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
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Self_;
use Webpatser\Uuid\Uuid;

use Illuminate\Http\Request;
trait ReportDBTrait
{
    use GeneralProcessTrait;


    public function createTempTable($tempTableName)
    {


        $tempname = $tempTableName . $this->getuserid();

        $table = "CREATE TABLE IF NOT EXISTS " . $tempname . "(transid integer ,descrip varchar(1000),mname varchar(10), name varchar(100),ryear year,
        colname varchar(100) ,tpaid  decimal(18,2),tamount  decimal(18,2),tbal  decimal(18,2),member_id varchar(100) ,
        date_paid date,ryearrange varchar(100),monthID integer,collectionID integer,oldID varchar(100))";
        $sqltrunc = "TRUNCATE TABLE " . $tempname;
        DB::statement($table);
        DB::statement($sqltrunc);

    }

    public function fetchMemberDataQuery(){

    return "select id,CONCAT( surname, ' ', other_names) as name,status_id,id,date_died,date_joined,date_joined_welfare,new_member_id,old_member_id from memberdetails ";

}

    public function fetchMemberDataQuery2(){

        return "select CONCAT( surname, ' ', other_names) name, date_joined,date_died,status_id,id as memid,new_member_id ,img_path from memberdetails ";

    }


    public function createFinalTempTable()
    {


        $tempname ='finalDebtReport'.$this->getuserid();

        $table = "CREATE TABLE IF NOT EXISTS " . $tempname . "(tmonth integer,tpaidmonth integer,descrip varchar(1000),mname varchar(10), name varchar(100),ryear year,
        colname varchar(100) ,tpaid  decimal(18,2),tamount  decimal(18,2),tbal  decimal(18,2),member_id varchar(100) ,
        date_paid date,ryearrange varchar(100),monthID integer,collectionID integer,oldID varchar(100))";
        $sqltrunc = "TRUNCATE TABLE " . $tempname;
        DB::statement($table);
        DB::statement($sqltrunc);

    }

}
