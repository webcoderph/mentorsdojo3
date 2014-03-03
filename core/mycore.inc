<?php 
session_start();
//sessions
if(isset($_GET['p']) && $_GET['p'] == 'fblogin') {

	$sesslife = false;
 
	if(empty($_SESSION['code'])) {
		if(isset($_GET['code'])) {
			$_SESSION['code'] = $_GET['code'];
		}
	 
		$_SESSION['access_token'] = null;
	}
	 
	if(!empty($_SESSION['code'])) {
		if(empty($_SESSION['access_token'])) {
			$token_url = 'https://graph.facebook.com/oauth/access_token?client_id=FACEBOOK_API_KEY&redirect_uri='.urlencode(WEBSITE_URL).'&client_secret=APP_SECRET&code='.$_SESSION['code'];
			$response = file_get_contents($token_url);
	 
			$cookie = null;
			parse_str($response, $cookie);
	 
			$graph_url = 'https://graph.facebook.com/me?fields=id,first_name,last_name,email,picture&access_token='.$cookie['access_token'];
			$user = json_decode(file_get_contents($graph_url));
				if($user) {
					$_SESSION['uid'] = $facebook_id = $user->id;
					$_SESSION['whoami'] = $user_email = $user->email;
					$_SESSION['loggedin'] = $sesslife = true;
				} else {
					$facebook_id = null;
					$user_email = null;
					$_SESSION['whoami'] = md5($_SERVER['REMOTE_ADDR']);
					$_SESSION['loggedin'] = false;
				}
	 
			$_SESSION['access_token'] = $cookie['access_token'];
		} else {
			$_SESSION['uid'] = $facebook_id = $user->id;
			$_SESSION['whoami'] = $user_email = $user->email;
			$_SESSION['loggedin'] = true;
		}
	}
}

//bootstrap pdo wrapper

try {
  
  $pdo = PDOWrapper::instance();
  $pdo->configMaster($server,$database,$userdb,$passworddb);
  $pdo->configSlave($server,$database,$userdb,$passworddb);
  //include 'Monolog/Logger.php';
   
} catch (Exception $e) {
  echo $e->getMessage() . "\n";
}

require 'functions.inc';

?>
