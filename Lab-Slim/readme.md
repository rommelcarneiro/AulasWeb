## Resumo

Este laboratório introduz o Slim, um framework focado na linguagem PHP utilizado para criação de aplicações Web. O Slim é um dispatcher ou um middleware que simplifica o tratamento de requisições HTTP. É muito prático para criação de APIs REST.

Este laboratório está completo e foi baseado nas video aulas do Lucas Silva (https://www.youtube.com/user/TheLucas8ism). Vale a pena dar uma olhada que tem o passo a passo sobre como montar uma aplicação MVC utilizando o Framework Slim.

Outros bons tutoriais sobre a API REST via Slim são: 
 - [PHP restful API framework : Slim Tutorial](http://www.alphansotech.com/blogs/php-restful-api-framework-slim-tutorial/)
 - [Artigo do iMasters](https://imasters.com.br/linguagens/php/aprenda-a-usar-o-restful-com-php-e-slim-framework/?trace=1519021197&source=single).

O site do framework Slim é o: (https://www.slimframework.com/).

## Examplo de código

Imagine que queira criar um Web Service que implemente as funções CRUD em uma determinada tabela de banco de dados e cuja interface segue a codificação JSON (Java Script Object Notation). O código necessário para o arquivo index.php é bastante simples, como mostrado abaixo

```php
<?php
require 'vendor/autoload.php';

$app = new \Slim\App ();

// Implementando a rotina GET - (R)etrieve
$app->get('/cliente', function ($request, $response, $args) {
  // implemente aqui o código para gerar o JSON
  dados = .... código que gera o JSON ....
  
  $response->getBody()->write(dados);
  
  // retorne o código JSON
  return $response;
});

// Implementando a rotina POST - (C)reate
$app->post('/cliente', function ($request, $response, $args) {
  // implemente aqui o código para salvar no banco de dados 
  .... código que faz INSERT no banco de dados ....
  
  // retorne o código de resposta HTTP correspondente
  return $response.withStatus(200)->write("Sucess");
});

```
