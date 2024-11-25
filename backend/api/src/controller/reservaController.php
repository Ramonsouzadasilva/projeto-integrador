<?php

<<<<<<< HEAD
class ReservaController
{
    public function listarReservas()
    {
        // Consultar as reservas no banco de dados e exibir na visão
    }

    public function mostrarFormularioReserva()
    {
        // Exibir formulário para a criação de uma nova reserva
    }

    public function fazerReserva()
    {
        // Registrar a reserva no banco de dados
    }

    public function cancelarReserva()
    {
        // Cancelar a reserva e mudar o status
    }

    public function mostrarRelatorio()
    {
        // Gerar o relatório de reservas, com gráfico de colunas
=======
require_once 'src/repository/reservaRepository.php';
require_once 'src/repository/mesarepository.php';

class ReservaController
{
    protected $reservaRepo;
    protected $mesaRepo;
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->reservaRepo = new ReservaRepository($pdo);
        $this->mesaRepo = new MesaRepository($pdo);
    }

    public function criarReserva($req, $res)
    {
        $dados = (array) $req->body();

        if (!isset($dados['nome_cliente'], $dados['data_inicio'], $dados['data_fim'], $dados['mesa_id'], $dados['funcionario_id'])) {
            return $res->json(['status' => 'error', 'message' => 'Dados faltando'], 400);
        }

        $data_inicio = explode(' ', $dados['data_inicio']);
        $data_fim = explode(' ', $dados['data_fim']);

        // Logic to separate date and time
        $data_inicio = $data_inicio[0];
        $hora_inicio = $data_inicio[1];

        $data_fim = $data_fim[0];
        $hora_fim = $data_fim[1];

        // Check availability
        if ($this->reservaRepo->verificarDisponibilidade($dados['mesa_id'], $data_inicio, $hora_inicio, $data_fim, $hora_fim)) {
            return $res->json(['status' => 'error', 'message' => 'Mesa não disponível para o horário solicitado'], 400);
        }

        $reserva = new Reserva(
            $dados['nome_cliente'],
            $data_inicio,
            $hora_inicio,
            $data_fim,
            $hora_fim,
            $dados['mesa_id'],
            $dados['funcionario_id']
        );

        // Save reservation
        $this->reservaRepo->salvarReserva($reserva);

        // Update table status
        $this->mesaRepo->atualizarStatusMesa($dados['mesa_id'], false);

        return $res->json(['status' => 'success', 'message' => 'Reserva realizada com sucesso']);
    }

    public function listarReservas($req, $res)
    {
        $reservas = $this->reservaRepo->listarReservas();
        return $res->json($reservas);
    }

    public function cancelarReserva($req, $res)
    {
        $id = $req->param('id');
        $this->reservaRepo->cancelarReserva($id);

        // Update table status
        $stmt = $this->pdo->prepare("SELECT mesa_id FROM reservas WHERE id = ?");
        $stmt->execute([$id]);
        $mesa_id = $stmt->fetchColumn();
        $this->mesaRepo->atualizarStatusMesa($mesa_id, true);

        return $res->json(['status' => 'success', 'message' => 'Reserva cancelada']);
>>>>>>> dev
    }
}
