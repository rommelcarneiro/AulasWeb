<?php
// Declara a URL de callback para a qual o Servidor de Autorização 
// deverá encaminhar o retorno com o código de autorização
$CALLBACK_URL = "http://localhost/AulasWeb/Lab-OAuth/OAuthCallback.php";

// Configuração da API do Google
$GOOGLE_API_AUTH_URL = "https://accounts.google.com/o/oauth2/auth";
$GOOGLE_API_TOKEN_URL = "https://accounts.google.com/o/oauth2/token";
$GOOGLE_API_RESOURCE_URL = "https://www.googleapis.com/oauth2/v1/userinfo";
$GOOGLE_CLIENT_ID = "6199248294-srq3i9ujbdr0ks0ckft5qsngrvmo4t78.apps.googleusercontent.com";
$GOOGLE_CLIENT_SECRET_KEY = "dotW00EHSR60Zos_Zuc5AsaN";
$GOOGLE_SCOPE = "https://www.googleapis.com/auth/plus.me";
    
// Configuração da API do Facebook
$FACEBOOK_API_AUTH_URL = "https://www.facebook.com/v2.8/dialog/oauth";
$FACEBOOK_API_TOKEN_URL = "https://graph.facebook.com/v2.8/oauth/access_token";
$FACEBOOK_API_RESOURCE_URL = "https://graph.facebook.com/v2.8/me";
$FACEBOOK_CLIENT_ID = "244927775973840";
$FACEBOOK_CLIENT_SECRET_KEY = "1e273f44b2197c0ced0aca856db5659d";
$FACEBOOK_SCOPE = "public_profile, email";

?>
