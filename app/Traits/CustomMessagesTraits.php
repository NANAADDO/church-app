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

trait CustomMessagesTraits
{

    public function send_visa_payment_link($token){

        return "https://app.slydepay.com/paylive/detailsnew.aspx?pay_token=$token&provider=visa";
    }

    public function send_intepay_payment_link($token){

        return "https://test.interpayafrica.com/interapi/confirmpayment?Token=".$token;
    }

}
