<?php
namespace Accredify;
use \GuzzleHttp\Client as GC;//HTTP CURL LIB
use \OAuth2\Client as Client;//Simple oAuth2 Client

class API{
	private static $oAuth2 = null;
	private  static $base_url;	

	public function __construct(){		
		self::$base_url = ($_ENV['APP_ENV'] == 'sandbox')? "https://api.sandbox.accredify.com/" : "https://api.accredify.com/";
		self::$oAuth2 = new Client($_ENV['APP_ID'], $_ENV['APP_SECRET']);
	}

	//Send Request to Accredify
	public static function send($multipart,$url){		
  		$client = new \GuzzleHttp\Client();			
		$guzzleResponse = $client->request('POST', $url,	[ 'multipart' => $multipart]);	
	            return json_decode($guzzleResponse->getBody(),true);
  	}


  	//Convert oAuth2 Code -> oAuth2 Access_Token
	public static function getAccessToken($code=null){
		$code = ($code !=  null)? $code : $_GET['code'];
		$response = self::$oAuth2->getAccessToken(
					self::$base_url.'oauth/token', 'authorization_code',  
					array('code' => $code, 'redirect_uri' =>$_ENV['REDIRECT_URI'])
				);	 	
		return $response['result'];
  	} 
	
	//Get Accredify Profile
	public static function getUser($access_token){
		$url = self::$base_url.'api/me.json';
		$multipart = [];
		$multipart[] = [
				'name'     => 'access_token',
				'contents' => $access_token
				];		
		return API::send($multipart,$url);	
	}

	//Get Accredify Connect Link
	public static function getConnectLink($state=null){
		$link = self::$base_url.'oauth/authorize?client_id='.$_ENV['APP_ID'].'&redirect_uri='.$_ENV['REDIRECT_URI'].'&response_type=code';
		return $link;		
	}		
}
?>
