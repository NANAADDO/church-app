<?php
//app/Helpers/User.php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class UserAuth
{

    public static function get_user_role_name()
    {
        $userrole = DB::table('roles')->where('id', $id)->first();


        if ($userrole) {
            return $userrole->name;

        } else {

            return 'N/A';
        }

    }

    public static function get_user_name()
    {
        If (!auth()->guest()) {
            return auth()->user()->name;
        }
    }

    public static function get_user_dynamic_details($colum)
    {

        return auth()->user()->$colum;

    }

    public static function get_user_branch()
    {
        $id = self::get_user_dynamic_details('branch_id');

        $userbranch = DB::table('branches')->where('id', $id)->first();

        if ($userbranch) {
            return $userbranch->name;

        } else {

            return 'N/A';
        }
    }

    public static function get_branch_code()
    {
        $id = self::get_user_dynamic_details('branch_id');

        $userbranch = DB::table('branches')->where('id', $id)->first();

        if ($userbranch) {
            return $userbranch->branch_code;

        } else {

            return 'N/A';
        }
    }


    public static function get_user_branch_size()
    {
        $id = self::get_user_dynamic_details('branch_id');
        $userbranch = DB::table('branches')->where('id', $id)->first();

        if ($userbranch) {
            return $userbranch->branch_size;

        } else {

            return 'N/A';
        }
    }

}
