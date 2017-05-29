<?php
session_start();
require "vendor/autoload.php";
require "config.php";

use GuzzleHttp\Client;

if (isset($_REQUEST['api'])) {
    // Obtem a identificação de qual API está
    // sendo utilizada (Google ou Facebook)
    $api = $_REQUEST['api'];

    if(isset($_GET['code'])) {
        // Obtem o código de autorizacão devolvido
        // pelo Servidor de Autorização
        $code = $_GET['code'];
    }
    else {
        header ("Refresh: 5; url=/AulasWeb/Lab-OAuth/");
        echo "OAuth code não informado";
        die;
    }        
    
    // De acordo com a API escolhida faz requisição
    // ao Servidor de Autorização
    switch($api) {
        case 'google': 
            // Dispara requisição para o Servidor de Autorização
            // do Google solicitando a token de acesso
            $client  = new Client ();
            $response = $client->request("POST", $GOOGLE_API_TOKEN_URL, [
                'verify' => false,
                'http_errors' => false,
                'form_params' => [
                    "code" => $code,
                    "client_id" => $GOOGLE_CLIENT_ID,
                    "client_secret" => $GOOGLE_CLIENT_SECRET_KEY,
                    "redirect_uri" => $CALLBACK_URL . "?api=google",
                    "grant_type" => "authorization_code"            
                ]
            ]);            
            break;
        case 'facebook' :
            // Dispara requisição para o Servidor de Autorização 
            // do Facebook solicitando a token de acesso
            $client  = new Client ();
            $response = $client->request("POST", $FACEBOOK_API_TOKEN_URL, [
                'verify' => false,
                'http_errors' => false,
                'form_params' => [
                    "code" => $code,
                    "client_id" => $FACEBOOK_CLIENT_ID,
                    "client_secret" => $FACEBOOK_CLIENT_SECRET_KEY,
                    "redirect_uri" => $CALLBACK_URL . "?api=facebook",
                    "grant_type" => "authorization_code"            
                ]
            ]);  
            break;
    }

    // obtem a token de acesso a partir do retorno do 
    // Servidor de Autorização e salva na sessão do usuário
    $data = json_decode($response->getBody());
    $_SESSION['token'] = $data->access_token;
    
    // Redireciona para a página inicial que irá obter 
    // os dados do usuário a partir do Servidor de Recursos
    header('Location: /AulasWeb/Lab-OAuth/');

}
else {  
    header ("Refresh: 5; url=/AulasWeb/Lab-OAuth/");
    echo "API não informada";
}
?>