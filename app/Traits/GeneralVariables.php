<?php
/**
 * Created by PhpStorm.
 * User: APPUSER3
 * Date: 10/8/2018
 * Time: 11:49 PM
 */

namespace App\Traits;


use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait GeneralVariables
{

    public function getcallcenterrole(){

        return Config::get('constants.Callcenter');
    }


    public function getadminrole(){

        return Config::get('constants.Admin');
    }
    public function getsalesmanagerrole(){

        return Config::get('constants.salesmanager');
    }

    public function getsalessupervisorrole(){

        return Config::get('constants.salessupervisor');
    }
    public function getsalesagentrole(){

        return Config::get('constants.salesagent');
    }
    public function getexecutiverrole(){

        return Config::get('constants.executive');
    }
    public function getcallcentersupervisorrole(){

        return Config::get('constants.callssupervisor');
    }


    public function getadminsalesrole(){
        $right =DB::table('group_rights')->where('id',2)->first();
       $right_array = explode(',',$right->group_ids);
       return $this->handelexceptionint($right_array);

    }
    public function getsalesforcerole(){
        $right =DB::table('group_rights')->where('id',4)->first();
        $right_array = explode(',',$right->group_ids);
        return $this->handelexceptionint($right_array);

    }

    public function getcallcenterforcerole(){
        $right =DB::table('group_rights')->where('id',5)->first();
        $right_array = explode(',',$right->group_ids);
        return $this->handelexceptionint($right_array);

    }

    public function handelexceptionstring($res){

        if($res){
         return $res;

        }
        else{

            return 'N/A';
        }

    }

    public function handelexceptionint($res){

        if($res){
            return $res;

        }
        else{

            return '0';
        }

    }


}
