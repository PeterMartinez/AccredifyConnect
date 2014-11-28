<?php 
namespace Accredify;
class Config{

	//Set HOST PATH to the example.php file to match shown redirect url for this example to work. 
	//Copy and Paste the contents of this file into  config.php file for testing. 
	//REMEBER TO USE YOUR OWN APPLICATION ID, SECRET, ETC WHEN GOING LIVE
	public $default = array(
					'application_id'=>'a669ef40f3d8e57744aa414a1b69a44edfbe4cf95d595b4440460c5dc46c35bc',
					'secret_key'=>'5d435fc73deae3a5c1956367be5cd7f389eaa1c73ada45129acbf2e54ff728ac',
					'redirect_uri'=>'http://testsdk.accredify.com/example.php',
					'button'=>'dark'//Light or Dark Button
				);
}

?>