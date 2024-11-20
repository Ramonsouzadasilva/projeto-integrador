<?php
require_once 'vendor/autoload.php';

use \phputil\router\Router;

$app = new Router();

$pdo = conectar();

$app->get('/', function ($req, $res) use ($pdo) {
    $res->send('Bem vindo ao sistema de Reservas!');
});


$app->get('/reservas', function ($req, $res)  use ($pdo) {
    $res->json();
});


$app->post('/reservas', function ($req, $res) use ($pdo) {
    $dados = (array) $req->body();
});

$app->listen();
