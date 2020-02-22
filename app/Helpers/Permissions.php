<?php
//app/Helpers/User.php
namespace App\Helpers;

use App\Permission;
use App\Permission_role;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Permissions {

    protected static $permission_table = 'permissions';
    protected static $group_table = 'group_type';
    protected static $event_table = 'event_type';


    public static function get_all_permissions()
    {

        $sql = 'select lower(CONCAT( e.event_name, " ", p.name )) as name,p.id as id from permissions p join event_type e on 
p.event_id = e.id';
        return  DB::select($sql);
    }

    public static function get_all_actions($id)
    {
        $array =[];

        $sql = 'select  event_id from permissions where parent_id = ?';

            foreach(DB::select($sql,[$id]) as $event) {


                $array[]=$event->event_id;
            }
            return $array;
    }

    public static function get_all_not_permissions($id)
    {
        $sql = "select lower(CONCAT( e.event_name, ' ', p.name )) as name,p.id  from   permissions p join event_type e on p.event_id = e.id where p.id not in (select p.id from permission_role pr join permissions p  on pr.permission_id 
 = p.id  where pr.role_id = ?)";
        $response = DB::select($sql,[$id]);

        return $response;

    }
    public static function get_all_in_permissions($id)
    {
        $sql = "select lower(CONCAT( e.event_name, ' ', p.name )) as name,p.id as id from permission_role pr join permissions p  on pr.permission_id 
 = p.id join event_type e on p.event_id = e.id where pr.role_id = ?";
        $response = DB::select($sql,[$id]);
        return $response;


    }

    public static function get_all_group()
    {

        return self::dbstructure(self::$group_table,'group_name','id');

    }

    public static function get_all_in_permissions_array($id)
    {
        $ids_string = implode(',', $id);

        $sql = "select lower(CONCAT( e.event_name, ' ', p.name )) as name,p.id as id from permission_role pr join permissions p  on pr.permission_id = p.id join event_type e on p.event_id = e.id where FIND_IN_SET(pr.role_id, :array)";
        $response = DB::select($sql,['array'=>$ids_string]);
        return $response;
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
    public static function dbstructure4($table,$data=[]){

        return  DB::table($table)->select($data)->get();
    }


    public static function db_count($table,$id){

        return  DB::table($table)->where('parent_id','=',$id)->count('id');
    }



    public static function get_all_in_event_permissions($selected=[]){
        $sort = '';
        $data = self::dbstructure2(self::$event_table);

        foreach ($data as $row){
            $sort.= '<label style="margin-top: 10px;">
<input name="events[]" value="'.$row->id.'" class="pull-left radio-checked"  type="checkbox"';
  if(in_array($row->id,$selected)){
      $sort.= 'checked';
  }

            $sort.='><strong style="padding-right: 20px;">'.$row->event_name.'</strong></label>';
        }

return '<div class="form-group-inner">
<div class="col-md-8 col-md-offset-2">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<label name="Permissions" class="login2"> Permissions</label>
</div>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
'.$sort.'
</div>
</div>
</div>
</div>';

}

    public static function get_total_permissions_in_module($id)
    {
           return  self::db_count(self::$permission_table,$id);
    }



    public static function confirm_user_permission($path)
    {
        $arr =[];
        $id = Auth::user()->id;
        $user_role =Roles::get_user_logged_in_role();

        $sql = " select  t2.event_id  from (select permission_id from permission_role where role_id = ? and  permission_id not in (select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) 
union select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) as t1  join (select p.id,p.event_id from parent_module pm join permissions p on 
pm.id = p.parent_id where pm.path_name =?   ) as t2 on 
t1.permission_id = t2.id   ";

        $response = DB::select($sql,[$user_role,$id,0,$id,1,$path]);

        foreach ($response as $con){
            $arr [] = $con->event_id;
        }
        return $arr;

    }


    public static function get_all_permissions_for_user($id,$role)
{
    $sql = "select lower(CONCAT( e.event_name, ' ', p.name )) as name,p.id as id from permission_role pr join permissions 
p  on pr.permission_id = p.id join event_type e on p.event_id = e.id where pr.role_id =?  and  pr.permission_id not in (select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) 
   ";
    $response = DB::select($sql,[$role,$id,0]);

    return $response;

}

    public static function get_all_permissions_for_user_revoke_invoke($id,$actiontype)
    {
        $sql = "select lower(CONCAT( e.event_name, ' ', p.name )) as name,r.permission_id as id from revoke_invoke_permissions r join permissions 
p  on r.permission_id = p.id join event_type e on p.event_id = e.id where r.user_id =?   and  r.action_type = ?";
        $response = DB::select($sql,[$id,$actiontype]);

        return $response;

    }


    public static function get_all_extra_permissions_for_user($role,$id){
$sql = "select lower(CONCAT( e.event_name, ' ', p.name )) as name,p.id  from   permissions p join event_type e on 
p.event_id = e.id where p.id not in (select t1.id from (select p.id from permission_role pr join permissions p  on pr.permission_id   = p.id  where pr.role_id = ?
union select permission_id as id from  revoke_invoke_permissions where user_id = ? and action_type =?) as t1
)";
$response = DB::select($sql,[$role,$id,1]);

return $response;

}
}
