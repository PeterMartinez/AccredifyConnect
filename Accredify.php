<?php
namespace Accredify;
include 'config.php';
use Accredify\Config as Config;
include('OAuth2/Client.php');
use OAuth2\Client as Client;

require('OAuth2/GrantType/IGrantType.php');
require('OAuth2/GrantType/AuthorizationCode.php');
class API{
	private static $oAuth2 = null;
	public static $config = array();
	private static $base_url = "https://api.accredify.com/";
	private static $buttons = array("light"=>"button2-ec0f714931c6d7ee33da9e88bce477b7.png","dark"=>"button1-5a9b44d02cbe6314c23d4d444cbdf8f3.png");

	public function __construct(){
		$config = new Config();
		self::$config = $config->default;
		self::$oAuth2 = new Client(self::$config['application_id'], self::$config['secret_key']);
	}

	//Generates Accredify Login Button Link, used for when the client wants to leverage their own button image.
	public static function getButtonLink(){
		$link = self::$base_url.'oauth/authorize?client_id='.self::$config['application_id'].'&redirect_uri='.self::$config['redirect_uri'].'&response_type=code';
		return $link;
	}

	//Generates Accredify Login Button HTML
	public static function getButton($class = null){
		$button = (isset(self::$config['button']) && strtolower(self::$config['button']) == "light")? self::$base_url.'assets/'.self::$buttons['light'] : self::$base_url.'assets/'.self::$buttons['dark'];
		$link = self::getButtonLink();
		return "<a href='{$link}'><img class='accredify_button {$class}' src='{$button}'/></a>";
	}

	//Returns oAuth2 Access Token for Client
	public static function getToken(){
		if(!isset($_GET['code'])){ return null;}		
	    	$response = self::$oAuth2->getAccessToken(self::$base_url.'oauth/token', 'authorization_code',  array('code' => $_GET['code'], 'redirect_uri' => self::$config['redirect_uri']));
	 	return (isset($response['result']['access_token']))? $response['result']['access_token'] : null;
	}

	//Returns  Accredify Client Information
	public static function getClient($accessToken = null){
		if($accessToken == null){return null;}
		self::$oAuth2->setAccessToken($accessToken);
    		$response = self::$oAuth2->fetch(self::$base_url.'api/v1/me.json');
    		return (isset($response['result']['legal_name']))?$response['result']:null;

	}

	//Returns  oAuth2 Access Token AND Accredify Client Information
	public static function getTokenandClient(){
		if(!isset($_GET['code'])){return null;}				
		$token = self::getToken();
		$client = self::getClient($token);
		return array("token"=>$token,'client'=>$client);
	}
}
?>
