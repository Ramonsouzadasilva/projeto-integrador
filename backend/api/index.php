<?php

// // Permitindo a origem correta (domínio e porta, sem especificar o arquivo)
// header("Access-Control-Allow-Origin: *");  // Ou defina para o seu domínio específico
// header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
// header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
// header("Access-Control-Allow-Credentials: true");  // Se você precisar de cookies/credenciais

// if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
//     // Responde ao preflight request
//     http_response_code(200);
//     exit();
// }

// Permitir qualquer origem (recomendado para testes ou desenvolvimento)
header("Access-Control-Allow-Origin:http://127.0.0.1:5500"); // Substitua * por "http://127.0.0.1:5500" para maior segurança
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Responda à requisição prévia (preflight)
    http_response_code(200);
    exit();
}


require_once 'vendor/autoload.php';
require_once 'src/database/conexao.php';
require_once 'src/reserva/rotas/rotas-reserva.php';
require_once 'src/mesa/rotas/rotas-mesa.php';
// require_once 'src/credenciais.php';

use \phputil\router\router;

// Criando a instância do Router
$app = new Router();

// Conectar ao banco de dados
$pdo = conectar();

criarRotasReserva($app, $pdo);

criarRotasMesa($app, $pdo);

$app->listen();
