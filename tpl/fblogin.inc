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
                $facebook_id = $user->id;
                $user_email = $user->email;
                $sesslife = true;
            } else {
                $facebook_id = null;
                $user_email = null;
            }
 
        $_SESSION['access_token'] = $cookie['access_token'];
    } else {
        $facebook_id = $user->id;
        $user_email = $user->email;
    }
}