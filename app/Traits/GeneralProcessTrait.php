<?php
/**
 * Created by PhpStorm.
 * User: APPUSER3
 * Date: 10/8/2018
 * Time: 11:49 PM
 */

namespace App\Traits;


use phpDocumentor\Reflection\Types\Self_;
use Webpatser\Uuid\Uuid;

trait GeneralProcessTrait
{





    public function  encryptpassword($pass){
        return  bcrypt($pass);

    }
    public function displaycrudview($varn,$type){

        $data =$varn;
        return view($this->viewname.".".$type)->with(compact('data'));

    }



    public function currentdate(){
        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $tdate = $carbon_today->format('Y-m-d');

        return $tdate;
}

    public function currentyear(){
        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $tdate = $carbon_today->format('Y');

        return $tdate;
    }

    public function convert_date_to_year($date){


      return  date('Y',strtotime($date));
    }


    public function currenttime(){
        $carbon_today = \Carbon\Carbon::now();
        $carbon_today->toDateString(); // same as ->format('Y-m-d')
        $time = $carbon_today->format('H:i:s');

        return $time;

    }

    public function dayofthedate(){
        $date = Self::currentdate();
        $day = date('D',strtotime($date));
        return $day;
    }

    public  function  uuidkey(){

      return  Uuid::generate();
    }

    public function checkifitarray($val){

        if(empty($val)) {
           return 1;
        }
        else{
return 0;
        }

    }

    public function implodearray($val){

        return  implode(",", $val);

    }

    public function explodearray($delim,$val){

        return  explode($delim, $val);

    }

    public function countarray($val){

        return  count($val);

    }

    public function countexplode($val){

      return $this->countarray( $this->explodearray($val));

    }



    public function getuserid()
    {

        return auth()->user()->id;
    }

    public function addsecondstotimestamp($timestmp,$add)
    {

        $new = strtotime($timestmp) + $add;

        return date('Y-m-d H:i:s',$new);
    }


}
