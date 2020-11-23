<?php

namespace App\Helpers;
use App\Models\payment_history;
use App\Traits\GeneralProcessTrait;
use Illuminate\Support\Facades\DB;
use App\Helpers\GeneralVariables;
class Payment {





   public static function get_payment_total_based_collection_id($id){

if($id==2) {
    $in = [2,4];
    $val = payment_history::whereIn('collection_id', $in)->where('date_paid', GeneralVariables::currentdate())->where('user_id', GeneralVariables::getuserid())->sum('amount_paid');

}
else if($id==0){
    $val = payment_history::where('date_paid', GeneralVariables::currentdate())->where('user_id', GeneralVariables::getuserid())->sum('amount_paid');

}
else {
    $val = payment_history::where('collection_id', $id)->where('date_paid', GeneralVariables::currentdate())->where('user_id', GeneralVariables::getuserid())->sum('amount_paid');

}

return $val;
}


    public static function get_payment_total_based_collection_id_and_date($id,$date){

        if($id==2) {
            $in = [2,4];
            $val = payment_history::whereIn('collection_id', $in)->where('date_paid', $date)->where('user_id', GeneralVariables::getuserid())->sum('amount_paid');

        }
        else if($id==0){
            $val = payment_history::where('date_paid', $date)->where('user_id', GeneralVariables::getuserid())->sum('amount_paid');

        }
        else {
            $val = payment_history::where('collection_id', $id)->where('date_paid', $date)->where('user_id', GeneralVariables::getuserid())->sum('amount_paid');

        }

        return $val;
    }


    public static function get_daily_payment_details_by_user($id){
       $ids = Given::get_church_given_based_on_group($id);


            $val = payment_history::whereIn('collection_id', $ids)->where('date_paid', GeneralVariables::currentdate())->where('user_id', GeneralVariables::getuserid())->get();



        return $val;
    }



    public static function get_payment_total_based_on_type_only($id,$total){

        $sql="select count(t1.member_id) as total  from (
(select sum(amount_paid) as amount,member_id  from 
 payment_histories  where collection_id=? and point_sub_id =? group by member_id) as t1) where t1.amount =?";

       return DB::select($sql,[3,$id,$total]);

    }

    public static function get_payment_total_commited_based_on_type_only($id,$total){

        $sql="select sum(t1.amount) as tamount , count(distinct(t1.member_id)) as comi  from (
(select amount_paid as amount ,member_id  from 
 payment_histories  where collection_id=? and point_sub_id =?) as t1)";

        return DB::select($sql,[3,$id,$total]);

    }


    public static function get_payment_daily_count($id){

return payment_history::where('date_paid','=',GeneralVariables::currentdate())->where('id' ,'<=',$id)->count();
    }





}
