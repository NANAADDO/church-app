<?php
//app/Helpers/User.php
namespace App\Helpers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class HTMLHelpers {

    public static function create_next_member_button($name,$butname){


       return  '<ul  class="">
        <li><p class="text-center" style="margin-top: 20px;" id="myTabedu1"><a class="btn btn-md btn-info" href="#'.$butname.'">'.$name.'</a> </p>
                                        </li>
               </ul>';
    }


}
