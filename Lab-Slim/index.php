<?php
require 'vendor/autoload.php';

$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$container = $app->getContainer();

$container['HomeController'] = function($container) use ($app) {
    return new BlogApp\Controllers\HomeController($container);
};

// Tratamento de GET para a home (/)
$app->get('/', 'HomeController:index')->setName('home');

// Tratamento de GET para /contato
$app->get('/contato', function($request, $response, $args) {
    // Obtem o path para contato
    $pathContato = $this->router->pathFor('contato');
    
    echo "<form action='$pathContato' method='post'>";
    echo "Mensagem: <input type='text' name='msg' value='' />";
    echo "<input type='submit' name='submit' value='Enviar' />";
    echo "</form>";
    
// Fecha a função indicando o nome do caminho: contato
})->setName('contato');


// Tratamento de POST para /contato
$app->post('/contato', function($request, $response, $args) {
    // Imprime os parametros passados
    print_r($request->getParams());    
    
    // Resposta apenas com código de retorno
    return $response.withStatus(200)->write("Sucess");
    
    
    // após o processamento desvia novamente para a home
    // return $response->withRedirect($this->router->pathFor('home'));
    
// Fecha a função indicando o nome do caminho    
})->setName('contato');

$app->get('/post/{id}', function($request, $response, $args) {
    print_r ($args) ;
    echo "id: " . $request->getAttribute('id');
});

$app->run();