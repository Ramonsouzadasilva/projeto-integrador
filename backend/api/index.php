<?php
require_once 'vendor/autoload.php';
require_once 'src/database/conexao.php';
require_once 'src/reserva/rotas/rotas-reserva.php';
require_once 'src/mesa/rotas/rotas-mesa.php';
require_once 'src/credenciais.php';

use \phputil\router\router;

// Criando a instância do Router
$app = new Router();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Credentials: true");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Conectar ao banco de dados
$pdo = conectar();
criarRotasReserva($app, $pdo);
criarRotasMesa($app, $pdo);

$app->listen();
