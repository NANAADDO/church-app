<?php
/**
 * Created by PhpStorm.
 * User: APPUSER3
 * Date: 10/8/2018
 * Time: 11:49 PM
 */

namespace App\Traits;

use App\Models\payment_history;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait PaymentHistoryTrait
{
    use GeneralProcessTrait;

    public function create_payment_history($mon,$memberID,$amount,$year_pledge,$pledeID,$type,$point_id)
    {
        $his['member_id'] = $memberID;
        $his['collection_id'] = $type;
        $his['date_paid'] = $this->currentdate();
        $his['amount_paid'] = $amount;
        $his['month_paid'] = $mon;
        $his['point_id'] = $point_id;
        $his['year'] = $year_pledge;
        $his['point_sub_id'] = $pledeID;
        $his['user_id'] = $this->getuserid();
         $res = payment_history::create($his);
    if($res){
    $cid = payment_history::find($res->id);
    $reID['receipt_id'] = self::get_next_payment_receipt_id($res->id);
    $cid->update($reID);
}

    }

    public static function get_payment_daily_count($id){

        return payment_history::where('date_paid','=',\App\Helpers\GeneralVariables::currentdate())->where('id' ,'<=',$id)->count();
    }

    public static function get_next_payment_receipt_id($cid){

return \App\Helpers\GeneralVariables::currentdatecombined().\App\Helpers\GeneralVariables::strpadvalue(self::get_payment_daily_count($cid),3);
    }



}
