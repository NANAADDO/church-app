<?php
//app/Helpers/User.php
namespace App\Helpers;

use App\RoleUser;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Roles {

    protected static $table = 'roles';
    protected static $user_table = 'role_user';



    public static function get_staff_role($id)
    {

        $res = RoleUser::where('user_id','=',$id)->first();
        return $res->role->name;

    }

    public static function get_all_roles()
    {

        return self::dbstructure3(self::$table,['id','name']);

    }



    public static function get_roles()
    {

        return self::dbstructure(self::$table,'name','id');

    }


    public static function get_all_not_in_roles($id)
    {
        $sql = "select * from roles where id  !='$id'";
        $response = DB::select($sql);
        return $response;
    }

    public static function get_user_logged_in_role()
{       $res = DB::table(self::$user_table)->where('user_id','=',Auth::user()->id)->first();
    return $res->role_id;
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

    public static function roles()
    {

       return self::get_all_roles()->pluck('name','id');

    }

    public static function userrole()
    {



    }

}
