<?php
//app/Helpers/User.php
namespace App\Helpers;

use App\Churchgiven;
use App\Churchgroup;
use App\Permission;
use App\Permission_role;
use App\User;

use Illuminate\Support\Facades\DB;

class Given {
    protected static $ch_table = 'churchgivens';





    public static function get_groups($id)
    {
     //return Churchgiven::s['path__name','aliases']);
    }

    public static function get_church_given()
    {
       return Churchgiven::get(['name','description']);
    }

    public static function get_church_given_based_on_group($id)
    {
        foreach(Churchgiven::where('groups_id',$id)->get() as $data){

            $arrayid[]=$data->id;

        }
        return $arrayid;
    }

    public static function get_church_given_based_on_group_id_only($id)
    {
      return   Churchgiven::where('groups_id', $id)->get();

    }


    public static function get_church_given_count()
    {
        return self::get_church_given()->count();
    }

    public static function get_church_given_info()
{
    $disp = self::get_church_given();
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
}
