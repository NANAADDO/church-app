<?php
//app/Helpers/User.php
namespace App\Helpers;

use App\Permission;
use App\Permission_role;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Menu {

    protected static $menu_table = 'parent_module';



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

        return  DB::table($table)->select($data)->get();
    }

    public static function dbstructure4($table,$column){
        return  DB::table($table)->select([$column])->get();
    }

    public static function db_menu_where($where,$column,$table,$id){

        return  DB::table($table)->where($where,'=',$id)->select([$column])->get();
    }



    public static function get_all_modules($id)
    {
      self::db_menu_where('group_type_id',['path_name','aliases'], self::$menu_table,$id);
    }

    public static function get_all_module_assign_to_role()
    {
       $id =  Auth::user()->id;
        $user_role =Roles::get_user_logged_in_role();

        $sql = " select  distinct(t3.group_name) as name ,t3.gid as id from (select permission_id from permission_role where role_id = ? and  permission_id not in (select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) 
union select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) as t1  join (select parent_id,id from permissions) as t2 on 
t1.permission_id = t2.id  join (select  distinct(g.group_name) as group_name,p.id,g.id as gid from group_type g join parent_module p on g.id = p.group_type_id group by g.group_name,p.id,g.id) as t3 on  t3.id=t2.parent_id ";

        $response = DB::select($sql,[$user_role,$id,0,$id,1]);
        return $response;

    }




    public static function get_all_sub_menu_role($menuID)
    {

        $id =  Auth::user()->id;
        $user_role =Roles::get_user_logged_in_role();

        $sql = " select  distinct(t2.aliases) as aliase ,t2.path_name  from (select permission_id from permission_role where role_id = ? and  permission_id not in (select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) 
union select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) as t1  join (select p.aliases,p.path_name,m.id from permissions m join parent_module
p on m.parent_id = p.id where p.group_type_id = ?) as t2 on 
t1.permission_id = t2.id ";

        $response = DB::select($sql,[$user_role,$id,0,$id,1,$menuID]);

       return $response;

    }

public static function get_all_sub_menu_permission()
{
    $arr =[];
    $id =  Auth::user()->id;
    $user_role =Roles::get_user_logged_in_role();

    $sql = " select  distinct(t2.pid) as permid  from (select permission_id from permission_role where role_id = ? and  permission_id not in (select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) 
union select permission_id from revoke_invoke_permissions where user_id= ? and action_type = ?) as t1  join (select p.id as pid,m.id from permissions m join parent_module
p on m.parent_id = p.id ) as t2 on 
t1.permission_id = t2.id ";

    $response = DB::select($sql,[$user_role,$id,0,$id,1]);
    foreach ($response as $row){

        $arr[]=$row->permid;
    }
    return $arr;
}

    public static function get_all_module_menus(){
   $response = '';
    $all = self::get_all_module_assign_to_role();

    foreach ($all as  $menu) {

        $response.='<li>
                        <a class="has-arrow" href="#" aria-expanded="false">
                            <span class="icon-wrap"><i class="fa fa-tools"></i></span> <span class="mini-click-non">'.$menu->name.'</span></a>
                      <ul class="submenu-angle" aria-expanded="false">
                 ';
        foreach (self::get_all_sub_menu_role($menu->id) as $row) {
            $response .= '<li><a title="" href="'.url($row->path_name).'"><span class="mini-sub-pro">'.$row->aliase.'</span></a></li>';

        }
        $response.=' </ul>
                    </li>';

        }

    return $response;
}
}
