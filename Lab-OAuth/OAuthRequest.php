<?php
session_start();
require "vendor/autoload.php";

$REDIRECT_URL = "http://localhost/AulasWeb/Lab-OAuth/OAuthCallback.php";
$url = '';

if (isset($_REQUEST['api'])) {
    $api = $_REQUEST['api'];
    $_SESSION['api'] = $api;

    if($api == 'google') {
        $GOOGLE_API_URL = "https://accounts.google.com/o/oauth2/auth";
        $GOOGLE_CLIENT_ID = "6199248294-srq3i9ujbdr0ks0ckft5qsngrvmo4t78.apps.googleusercontent.com";
        $GOOGLE_CLIENT_SECRET_KEY = "geCtqwwWaQDhutwYv4uHgE2G";
        $GOOGLE_SCOPE = "https://www.googleapis.com/auth/plus.me";

        $params = array(
            "response_type" => "code",
            "client_id" => $GOOGLE_CLIENT_ID,
            "redirect_uri" => $REDIRECT_URL . "?api=google",
            "scope" => $GOOGLE_SCOPE
        );

        $url = $GOOGLE_API_URL . '?' . http_build_query($params);
    }
    elseif ($api == 'facebook') {
        $FACEBOOK_URL = 'https://www.facebook.com/v2.8/dialog/oauth';
        $FACEBOOK_CLIENT_ID = '244927775973840';
        $FACEBOOK_SCOPE = 'public_profile, email, user_location';
        $FACEBOOK_CLIENT_SECRET_KEY = '4a2c70ae1bd579239a8f72b16397fd30';
        $params = array(
            "response_type" => "code",
            "client_id" => $FACEBOOK_CLIENT_ID,
            "redirect_uri" => $REDIRECT_URL . "?api=facebook",
            "scope" => $FACEBOOK_SCOPE
        );
        $url = $FACEBOOK_URL . '?' . http_build_query($params);
    }

    header("Location: " . $url);
}
else {  
    header ("Refresh: 5; url=/AulasWeb/Lab-OAuth");
    echo "API não informada";
}
?>