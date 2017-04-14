<?php
session_start();
require "vendor/autoload.php";

$CLIENT_ID = "6199248294-srq3i9ujbdr0ks0ckft5qsngrvmo4t78.apps.googleusercontent.com";
$CLIENT_SECRET_KEY = "geCtqwwWaQDhutwYv4uHgE2G";

use GuzzleHttp\Client;

if (isset($_REQUEST['api'])) {
    $api = $_REQUEST['api'];

    if(isset($_GET['code'])) {
        // try to get an access token
        $code = $_GET['code'];
    }
    else {
        header ("Refresh: 5; url=/AulasWeb/Lab-OAuth/");
        echo "OAuth code não informado";
        die;
    }        
    
    switch($api) {
        case 'google': 
            $GOOGLE_API_URL = "https://accounts.google.com/o/oauth2/token";
            $GOOGLE_CLIENT_ID = "6199248294-srq3i9ujbdr0ks0ckft5qsngrvmo4t78.apps.googleusercontent.com";
            $GOOGLE_CLIENT_SECRET_KEY = "geCtqwwWaQDhutwYv4uHgE2G";
            $GOOGLE_SCOPE = "https://www.googleapis.com/auth/plus.me";

            $client  = new Client ();
            $response = $client->request("POST", $GOOGLE_API_URL, [
                'verify' => false,
                'http_errors' => false,
                'form_params' => [
                    "code" => $code,
                    "client_id" => $GOOGLE_CLIENT_ID,
                    "client_secret" => $GOOGLE_CLIENT_SECRET_KEY,
                    "redirect_uri" => "http://localhost/AulasWeb/Lab-OAuth/OAuthCallback.php?api=google",
                    "grant_type" => "authorization_code"            
                ]
            ]);            
            break;
        case 'facebook' :
            $FACEBOOK_URL = 'https://graph.facebook.com/v2.8/oauth/access_token';
            $FACEBOOK_CLIENT_ID = '244927775973840';
            $FACEBOOK_SCOPE = 'public_profile, email';
            $FACEBOOK_CLIENT_SECRET_KEY = '4a2c70ae1bd579239a8f72b16397fd30';
            
            $client  = new Client ();
            $response = $client->request("POST", $FACEBOOK_URL, [
                'verify' => false,
                'http_errors' => false,
                'form_params' => [
                    "code" => $code,
                    "client_id" => $FACEBOOK_CLIENT_ID,
                    "client_secret" => $FACEBOOK_CLIENT_SECRET_KEY,
                    "redirect_uri" => "http://localhost/AulasWeb/Lab-OAuth/OAuthCallback.php" . "?api=facebook",
                    "grant_type" => "authorization_code"            
                ]
            ]);  
            break;
    }

    $data = json_decode($response->getBody());
    $_SESSION['token'] = $data->access_token;
    header('Location: /AulasWeb/Lab-OAuth/');

}
else {  
    header ("Refresh: 5; url=/AulasWeb/Lab-OAuth/");
    echo "API não informada";
}
?>