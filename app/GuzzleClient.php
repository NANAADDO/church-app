<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\BadResponseException;

use App\Http\Requests;

class GuzzleClient extends Client
{
    
/*************GETTING TOKEN AUTHENTICATION FROM PAYMENT PLATFORM************/
	
public function GATEWAY_AUTHENTICATION_TOKEN($endpoint,$username,$pass,$basictoken){

	try {
	
  $response = $this->post($endpoint, [
    'auth' => [
       $username, 
       $pass
    ],
	'header' => [
        'Authorization​' => 'Basic $basictoken'
    ]
	
]);

	$datatoke=$response ->getBody()->getContents();
$response ->getBody()->close();
$geting=json_decode($datatoke);
   $datatoken = $geting->token;
   return $datatoken;
   } catch (RequestException $e) {
  
  
   return [
        'errors'    => json_decode($e->getResponse()->getBody()->getContents(), true)
    ];
}
}


/*************POSTING TRANSACTION TO GATEWAY USING GUZZLECLIENT************/

public function POSTING_TRANSACTION_TO_GATEWAYS_GUZZLE($endpoint,$body,$token){
	
	
	try {

	$response = $this->post($endpoint, [
	'body' => $body,
	'header' => [
       'accept'=> 'application/json',
    'authorization'=> 'Bearer'.$token,
    'content-type'=> 'application/json'
    ]
	
]);
/*$code = $response->getStatusCode();
	$datatoke=$response ->getBody()->getContents();
$response ->getBody()->close();
$geting=json_decode($datatoke);*/
   return [
        'success'    => json_decode($response->getResponse()->getBody()->getContents(), true)
    ];

} catch (RequestException $e) {
  
  
   return [
        'errors'    => json_decode($e->getResponse()->getBody()->getContents(), true)
    ];
}
}


/*************POSTING TRANSACTION TO GATEWAY USING CURLCLIENT************/

public function POSTING_TRANSACTION_TO_GATEWAYS_CURL($endpoint,$body){

    $curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $endpoint,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $body,
  CURLOPT_HTTPHEADER => array(
    "accept: application/json",
    "content-type: application/json"

  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$split  = json_decode($response,true);
//$de = $split->ResponseCode;
if($err){
 return [
    	'error'=> $err
		];
}


else{
	 
	 return $split;
		    
	
	
}
	
	
	
  
}

}
