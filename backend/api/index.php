<?php
require_once 'vendor/autoload.php';
require_once 'src/database/conexao.php';
require_once 'src/routes/reserva-routes.php';

// $app->post('/reservas', function ($req, $res) use ($pdo) {
//     $dados = (array) $req->body();

//     // Validação de dados de entrada
//     if (!isset($dados['nome_cliente'], $dados['data_inicio'], $dados['data_fim'], $dados['mesa_id'], $dados['funcionario_id'])) {
//         $res->json(['status' => 'error', 'message' => 'Dados faltando'], 400);
//         return;
//     }

//     // Separar data e hora
//     $data_inicio = explode(' ', $dados['data_inicio']);
//     $data_fim = explode(' ', $dados['data_fim']);

//     $data_inicio = $data_inicio[0]; // 'YYYY-MM-DD'
//     $hora_inicio = $data_inicio[1]; // 'HH:MM:SS'

//     $data_fim = $data_fim[0]; // 'YYYY-MM-DD'
//     $hora_fim = $data_fim[1]; // 'HH:MM:SS'

//     // Verificar disponibilidade da mesa
//     $stmt = $pdo->prepare("SELECT * FROM reservas WHERE mesa_id = ? AND ((data = ? AND hora_inicio BETWEEN ? AND ?) OR (data = ? AND hora_fim BETWEEN ? AND ?))");
//     $stmt->execute([
//         $dados['mesa_id'],
//         $data_inicio,
//         $hora_inicio,
//         $hora_fim,
//         $data_fim,
//         $hora_inicio,
//         $hora_fim
//     ]);

//     if ($stmt->rowCount() > 0) {
//         $res->json(['status' => 'error', 'message' => 'Mesa não disponível para o horário solicitado'], 400);
//         return;
//     }

//     // Inserir reserva
//     $stmt = $pdo->prepare("INSERT INTO reservas (nome_cliente, data, hora_inicio, hora_fim, mesa_id, funcionario_id) VALUES (?, ?, ?, ?, ?, ?)");
//     $stmt->execute([
//         $dados['nome_cliente'],
//         $data_inicio,
//         $hora_inicio,
//         $hora_fim,
//         $dados['mesa_id'],
//         $dados['funcionario_id']
//     ]);

//     // Atualizar status da mesa
//     $stmt = $pdo->prepare("UPDATE mesas SET disponivel = FALSE WHERE id = ?");
//     $stmt->execute([$dados['mesa_id']]);

//     $res->json(['status' => 'success', 'message' => 'Reserva realizada com sucesso']);
// });


// // Rota para listagem de reservas
// $app->get('/reservas', function ($req, $res) use ($pdo) {
//     $stmt = $pdo->query("SELECT * FROM reservas WHERE data_inicio >= NOW() ORDER BY data_inicio ASC");
//     $reservas = $stmt->fetchAll();
//     $res->json($reservas);
// });

// // Rota para cancelar reserva
// $app->delete('/reservas/{id}', function ($req, $res) use ($pdo) {
//     $id = $req->param('id');

//     // Verificar se a reserva existe
//     $stmt = $pdo->prepare("SELECT * FROM reservas WHERE id = ?");
//     $stmt->execute([$id]);
//     $reserva = $stmt->fetch();

//     if (!$reserva) {
//         $res->json(['status' => 'error', 'message' => 'Reserva não encontrada'], 404);
//         return;
//     }

//     // Alterar status para cancelada
//     $stmt = $pdo->prepare("UPDATE reservas SET status = 'cancelada' WHERE id = ?");
//     $stmt->execute([$id]);

//     // Atualizar a mesa para disponível
//     $stmt = $pdo->prepare("UPDATE mesas SET disponivel = TRUE WHERE id = ?");
//     $stmt->execute([$reserva['mesa_id']]);

//     $res->json(['status' => 'success', 'message' => 'Reserva cancelada']);
// });

use \phputil\router\router;

// Criando a instância do Router
$app = new Router();

// Conectar ao banco de dados
$pdo = conectar();
defineRoutes($app, $pdo);

$app->listen();
