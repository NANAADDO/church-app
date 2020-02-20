<?php
//app/Helpers/User.php
namespace App\Helpers;

use App\Branch;
use App\Churchgiven;
use App\Churchgroup;
use App\Countries;
use App\Gender;
use App\Hometown;
use App\Locality;
use App\Maritalstatus;
use App\Marriagetype;
use App\Model\Status;
use App\Models\collectiongroup;
use App\Models\IDTypes;
use App\Models\Messagetag;
use App\Models\Months;
use App\Models\Paymentplantype;
use App\Models\Questionoption;
use App\Models\Textmessage;
use App\Models\Title;
use App\Models\Transport;
use App\Permission;
use App\Permission_role;
use App\Profession;
use App\Qualification;
use App\Region;
use App\Relationship;
use App\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class DBoptions {

    protected static $menu_table = 'parent_module';


    public static function get_all_month()
    {
        return self::dbstructure(Months::class,'name','id');
    }

    public static function get_all_years()
{
    $getyears = [];
    $c_year = GeneralVariables::currentyear();

    for($i=config('relatedvariables.ch_config.start_year'); $i <=$c_year;$i++){

        $getyears[$i]=$i;
    }
    return $getyears;
}

    public static function get_dynamic_relationship($type,$data = [])
    {
       if($type ==1) {
           return   Relationship::wherein('id', $data)->select('name','id')->get();
       }

       else{
           return Relationship::wherenotin('id', $data)->select('name','id')->get();

       }
    }

    public static function get_all_status()
    {

        return self::dbstructure(Status::class,'name','id');

    }
    public static function get_all_funerals()
    {

        return self::dbstructure(Transport::class,'description','id');

    }
    public static function get_all_regions()
    {

        return self::dbstructure(Region::class,'name','id');

    }

    public static function get_all_branches()
    {

        return self::dbstructure(Branch::class,'name','id');

    }

    public static function get_all_titles()
    {

        return self::dbstructure(Title::class,'name','id');

    }

    public static function get_all_hometowns()
    {

        return self::dbstructure(Hometown::class,'name','id');

    }

    public static function get_all_localities()
    {

        return self::dbstructure(Locality::class,'name','id');

    }
    public static function get_all_localities1()
    {

        return self::dbstructure3('locality',['name','id']);

    }


    public static function get_all_genders()
    {

        return self::dbstructure(Gender::class,'name','id');

    }



    public static function get_all_countries()
    {

        return self::dbstructure(Countries::class,'name','id');

    }

    public static function get_all_options()
    {

        return self::dbstructure(Questionoption::class,'name','id');

    }
    public static function get_all_profession()
    {

        return self::dbstructure(Profession::class,'name','id');

    }

    public static function get_all_qualification()
    {

        return self::dbstructure(Qualification::class,'name','id');

    }

    public static function get_all_relationship()
    {

        return self::dbstructure(Relationship::class,'name','id');

    }

    public static function get_all_relationship1()
    {

        return self::dbstructure3('relationship',['name','id']);

    }

    public static function get_all_marital_status()
    {

        return self::dbstructure(Maritalstatus::class,'name','id');

    }
    public static function get_all_church_groups()
    {

        return self::dbstructure(Churchgroup::class,'name','id');

    }
    public static function get_all_collections()
    {

        return self::dbstructure(Churchgiven::class,'name','id');

    }

    public static function get_all_payment_type()
    {

        return self::dbstructure(Paymentplantype::class,'name','id');

    }

    public static function get_all_id_type()
    {

        return self::dbstructure(IDTypes::class,'name','id');

    }


    public static function get_all_payment_groups()
    {

        return self::dbstructure(collectiongroup::class,'name','id');

    }

    public static function get_all_marriage_types()
    {

        return self::dbstructure(Marriagetype::class,'name','id');

    }
    public static function get_all_sms_tag()
{

    return self::dbstructure(Messagetag::class,'name','id');

}
    public static function get_all_message_text()
{

    return self::dbstructure(Textmessage::class,'title','id');

}

    public static function get_all_message_content()
    {

        return self::dbstructure3('textmessages',['content','id']);

    }
    public  static function get_all_collection_based_groups($value){

        return self::dbstructure5(Churchgiven::class,'name','id','groups_id',$value);
    }



    public static function get_all_memberID()
    {

        return self::dbstructure3('memberdetails',['new_member_id','id','surname','other_names','date_joined']);

    }



    public static function dbstructure($table,$textname,$dbkey){

    return  $table::orderby($textname)->pluck($textname,$dbkey)->toarray();
}

    public static function dbstructure5($table,$textname,$dbkey,$where,$value){

        return  $table::orderby($textname)->where($where,$value)->pluck($textname,$dbkey);
    }
    public static function dbstructure2($table){

        return  DB::table($table)->get();
    }

    public static function dbstructure3($table,$data=[]){

        return  DB::table($table)->select($data)->get();
    }


}
