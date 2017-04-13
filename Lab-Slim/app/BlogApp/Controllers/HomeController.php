<?php
    namespace BlogApp\Controllers;
    use BlogApp\Controllers\Controller;

    class HomeController extends Controller{
        
        public function index ($request, $response, $args) {
            echo "Olá Mundo - Via controller!!!";        
        }
    }