<?php
require_once 'mesa-controller.php';

function criarRotasMesa($app, PDO $pdo)
{
    $mesaController = new MesaController($pdo);

    $app->get('/mesas', function ($req, $res) use ($mesaController) {
        $mesaController->listarMesas($req, $res);
    });
}
