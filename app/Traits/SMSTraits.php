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




    public function send_sms($mobile_number,$notification){
        $client = new Client();

        $response = $client->GET('http://bulk.mnotify.net//smsapi?key=782050755566bb6a2c8f&to='.$mobile_number.'&msg='.$notification.'&sender_id=WELL-LIFE');

        return $response->getBody()->getContents();
    }

    public function set_guzzle()
    {

    }

}
