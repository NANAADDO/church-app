<?php
//app/Helpers/User.php
namespace App\Helpers;

use App\Churchgiven;
use App\Churchgroup;
use App\Permission;
use App\Permission_role;
use App\User;

use Illuminate\Support\Facades\DB;

class Group {

    protected static $group_table = 'group_type';
    protected static $chgroup_table = 'churchgroups';



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

    public static function db_count($table,$id){

        return  DB::table($table)->where('parent_id','=',$id)->count('id');
    }


    public static function get_all_permissions_names_in_event($id)
    {
           return  self::db_count(self::$permission_table,$id);
    }


    public static function get_groups($id)
    {
     //return Churchgiven::s['path__name','aliases']);
    }

    public static function get_church_group()
    {
       return Churchgroup::get(['name','description','id']);
    }

    public static function get_church_group_count()
    {
        return self::get_church_group()->count();
    }

    public static function get_church_group_info()
{
    $disp = self::get_church_group();
    $db = '';
    $th=['name','Description'];

    $thr = '';
    foreach ($th as $key=>$value){

        $thr.='<th>'.$value.'</th>';
    }
if(empty($disp))
{
$db.= '<P style="color: red;">no data found..</P>';

}
else {
    $db .= '
<div class="table-responsive"><table class="table border-table">
       <thead><tr>' . $thr . ' </tr></thead><tbody> <tr>';
    foreach ($disp as $val)
    {
        $db.='<tr> 
          <td>'.$val->name.'</td><td>'.$val->description.'</td>
</tr>';
     }
    $db .= '</tr> </tbody> </table> </div>';

}
return $db;
}


    public static function get_all_member_belong_group($id)
    {
        $array =[];

        $sql = 'select  groups_id as id from memberchurchgroups where member_id = ?';

        foreach(DB::select($sql,[$id]) as $event) {


            $array[]=$event->id;
        }
        return $array;
    }



    public static function get_all_in_event_groups($selected=[]){
        $sort = '';
        $data = self::get_church_group();

        foreach ($data as $row){
            $sort.= '<label style="margin-top: 10px;">
<input name="churchgroups[]" value="'.$row->id.'" class="pull-left radio-checked"  type="checkbox"';
            if(in_array($row->id,$selected)){
                $sort.= 'checked';
            }

            $sort.='><strong style="padding-right: 20px;">'.$row->name.'</strong></label>';
        }

        return '<div class="form-group-inner">
<div class="col-md-8 col-md-offset-2">
<div class="row">
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<label name="" class="login2"> Church Groups</label>
</div>
<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
'.$sort.'
</div>
</div>
</div>
</div>';

    }
}
