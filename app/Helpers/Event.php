<?php
//app/Helpers/User.php
namespace App\Helpers;

use App\Permission;
use App\Permission_role;
use App\User;
use Illuminate\Support\Facades\DB;

class Event {

    protected static $event_table = 'event_type';



    public static function get_all_group()
    {

        return self::dbstructure3(self::$group_table,['id','group_name']);

    }


    public static function dbstructure($table,$textname,$dbkey){

      return  DB::table($table)->orderBy($textname)->pluck($textname,$dbkey);
    }
    public static function dbstructure2($table){

        return  DB::table($table)->get();
    }

    public static function dbstructure3($table,$data=[]){

        return  DB::table($table)->select([$data[0].' as id',$data[1] .' as name' ])->get();
    }

    public static function dbstructure4($table,$column){
        return  DB::table($table)->select([$column])->get();
    }

    public static function db_count($table,$id){

        return  DB::table($table)->where('parent_id','=',$id)->count('id');
    }


    public static function all_event_in_module($id){
$array = [];
        $es = DB::table('permissions')->where('parent_id','=',$id)->get();
        foreach($es as $event){


            $array[]=$event->event_id;
        }
return $array;
    }

    public static function get_all_permissions_names_in_event($id)
    {
           return  self::db_count(self::$permission_table,$id);
    }


    public static function get_event_badge($id)

    {

        $ids = self::all_event_in_module($id);
        $badge = '';
        $bad ='';

        if (in_array(1 ,$ids)) {
            $badge.= '<span class="badge badge-info">create</span> ';
        } if (in_array(2 ,$ids)) {
            $badge.= '<span class="badge badge-primary">show</span> ';
        } if (in_array(3 ,$ids)) {
            $badge.= '<span class="badge badge-success">edit</span> ';
        if (in_array(4 ,$ids)){
            $badge.= '<span class="badge badge-danger">delete</span> ';
        }


    }

        return $badge;
    }
}
