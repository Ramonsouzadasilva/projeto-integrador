<?php
require_once 'src/mesa/controller/mesa-controller.php';

function criarRotasMesa($app, PDO $pdo)
{
    $mesaController = new MesaController($pdo);

    // Rota principal
    $app->get('/', function ($req, $res) {
        $res->send('Bem-vindo ao sistema de Reservas!');
    });

    $app->get('/mesas', function ($req, $res) use ($mesaController) {
        $mesaController->listarMesas($req, $res);
    });
}
