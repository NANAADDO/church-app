<?php

namespace App\Helpers;

use App\Models\Memberdetail;
use App\Models\Religiousprofle;
use Illuminate\Support\Facades\DB;

class Member {

    protected static $branch_table = '';


public static function get_total_member_transport() {
	  $data = Memberdetail::where('status_id',1)->count();

        return $data;
    }






    public static function get_total_member() {
        $data = Memberdetail::count();

    return $data;
    }
    public static function get_total_based_on_col($column,$value) {
        $data = Religiousprofle::where($column,$value)->count();

        return $data;
    }
    public static function get_total_based_on_col_mem($column,$value) {
        $data = Memberdetail::where($column,$value)->count();

        return $data;
    }
    public static function get_current_date(){

        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $date = $carbon_today->format('Y');


        return $date;




    }
    public static function get_current_date2(){

        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $date = $carbon_today->format('Y-m-d');

        return $date;




    }



    public static  function get_date_splitter($date){

       $result =  explode("-",$date);

       if(self::get_current_date() > 2099) {

           return $result[1] .substr($result[0], -3);
       }
        if(self::get_current_date() <= 2099) {

            return $result[1] .substr($result[0], -2);
        }


    }



    public  static function generate_next_churchID($id,$date){
        $branchcode = UserAuth::get_branch_code();
        $size = UserAuth::get_user_branch_size();
        $data = self::get_date_splitter($date);

        $acttot = str_pad($id,$size,"0",STR_PAD_LEFT);
        $newID = $branchcode.$data.$acttot;
        return $newID;
    }


    public static function get_state($id)
    {
        $badge = '';
        if($id==1){
            $badge = '<span class="badge badge-danger">No</span>';
        }
        else if($id==2){
            $badge = '<span class="badge badge-success">Yes</span>';
        }
        else{

            $badge = '<span class="badge badge-danger">No</span>';
    }

        return $badge;
    }


}
