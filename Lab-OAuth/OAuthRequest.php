<?php
session_start();
require "vendor/autoload.php";
require "config.php";

// Redireciona o usuário para que possa fazer a concessão de acesso 
// para esta aplicação junto ao Servidor de Autorização
//
// Verifica qual a API a ser utilizada (Google | Facebook)
if (isset($_REQUEST['api'])) {
    $api = $_REQUEST['api'];
    $_SESSION['api'] = $api;

    // Prepara a URL de redirecionamento
    $url = '';
    if($api == 'google') {
        $params = array(
            "response_type" => "code",
            "client_id" => $GOOGLE_CLIENT_ID,
            "redirect_uri" => $CALLBACK_URL . "?api=google",
            "scope" => $GOOGLE_SCOPE
        );
        $url = $GOOGLE_API_AUTH_URL . '?' . http_build_query($params);
    }
    elseif ($api == 'facebook') {
        $params = array(
            "response_type" => "code",
            "client_id" => $FACEBOOK_CLIENT_ID,
            "redirect_uri" => $CALLBACK_URL . "?api=facebook",
            "scope" => $FACEBOOK_SCOPE
        );
        $url = $FACEBOOK_API_AUTH_URL . '?' . http_build_query($params);
    }

    // Rerireciona o usuário para o Servidor de Autorização
    header("Location: " . $url);
}
else {  
    header ("Refresh: 5; url=/AulasWeb/Lab-OAuth");
    echo "API não informada";
}
?>