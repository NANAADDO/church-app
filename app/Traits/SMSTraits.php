<?php
/**
 * Created by PhpStorm.
 * User: APPUSER3
 * Date: 10/8/2018
 * Time: 11:49 PM
 */

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

trait SMSTraits
{

    use HttpClient;




    public function sendbulksms($contact,$tag,$message,$state,$schedule_date){

$endPoint = 'https://api.mnotify.com/api/sms/quick';
$apiKey = 'd1h7iicBTAnWOPD7168W3mhKi1fWhefvgwDzPQaIqyEfo';
$url = $endPoint . '?key=' . $apiKey;
$data = [
    'recipient' => $contact,
    'sender' => $tag,
    'message' => $message,
    'is_schedule' => $state,
    'schedule_date' => $schedule_date

];
return $this->curl_client($data,$url);


    }

    public function checksmsbalance(){

        $endPoint = 'https://api.mnotify.com/api/balance/voice';
        $apiKey = 'd1h7iicBTAnWOPD7168W3mhKi1fWhefvgwDzPQaIqyEfo';
        $url = $endPoint . '?key=' . $apiKey;


    }
}
