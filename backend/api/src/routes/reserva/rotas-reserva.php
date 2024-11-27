<?php

// routes.php

require_once 'src/controller/ReservaController.php';

function defineRoutes($app, $pdo)
{
    $reservaController = new ReservaController($pdo);

    // Rota principal
    $app->get('/', function ($req, $res) {
        $res->send('Bem-vindo ao sistema de Reservas!');
    });

    // Rota para criar reservas
    $app->post('/reservas', function ($req, $res) use ($reservaController) {
        $reservaController->criarReserva($req, $res);
    });

    $app->get('/reservas', function ($req, $res) use ($reservaController) {
        $reservaController->listarReservas($req, $res);
    });

    // Rota para cancelar reserva
    $app->put('/reservas/{id}', function ($req, $res) use ($reservaController) {
        $reservaController->cancelarReserva($req, $res);
    });
}
