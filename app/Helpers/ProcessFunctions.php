<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class ProcessFunctions {


    public static function get_month_to_begin_collection_calculation_from_date_joined($m,$d){
        $mleft = 12 - $m;
        if($mleft==0){

            if($d > 15){
                $mmonth = 0;
            }
            else{

                $mmonth = 1;
            }
        }
        else{

            if($d > 15){
                $mmonth = $mleft;
            }
            else{

                $mmonth = $mleft + 1;
            }
        }

        return $mmonth;

    }

    public static function get_month_to_begin_collection_calculation_from_date_died($m,$d){
        $mleft = 3;
        if($mleft==0){

            if($d > 15){
                $mmonth = 0;
            }
            else{

                $mmonth = 1;
            }
        }
        else{

            if($d > 15){
                $mmonth = $mleft;
            }
            else{

                $mmonth = $mleft + 1;
            }
        }

        return $mmonth;

    }


    public static function get_month_to_joined_church_to_start_contribution($m,$d){
        $mleft =$m;
        if($mleft==12){

            if($d > 15){
                $mmonth = 0;
            }
            else{

                $mmonth = $m;
            }
        }
        else{

            if($d > 15){
                $mmonth = $mleft + 1;
            }
            else{

                $mmonth = $mleft;
            }
        }

        return $mmonth;

    }


    public static function get_month_to_begin_collection_calculation_from_date_joined_on_show($m,$d){

            if($d > 15){
                if($m==12){
                  $mmonth=0;
                }
                else {
                    $mmonth = $m + 1;
                }
            }
            else{

                $mmonth = $m;
            }


        return $mmonth;

    }




}
