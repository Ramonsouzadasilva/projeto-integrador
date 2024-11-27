<?php

require_once 'src/repository/reserva/reservaRepository.php';
require_once 'src/repository/mesa/mesarepository.php';

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

        // Verifique se todas as chaves estão presentes
        if (!isset($dados['nomeCliente'], $dados['data'], $dados['horarioInicial'], $dados['horarioTermino'], $dados['mesa'], $dados['funcionario'])) {
            return $res->json(['status' => 'error', 'message' => 'Dados faltando'], 400);
        }

        // Verificar disponibilidade
        if ($this->reservaRepo->verificarDisponibilidade(
            $dados['mesa'],
            $dados['data'],
            $dados['horarioInicial'],
            $dados['horarioTermino'],
        )) {
            return $res->json(['status' => 'error', 'message' => 'Mesa não disponível para o horário solicitado'], 400);
        }

        // Criar nova reserva
        $reserva = new Reserva(
            null, // id é auto-incremento, então passa null
            $dados['nomeCliente'],
            $dados['mesa'],
            $dados['data'],
            $dados['horarioInicial'],
            $dados['horarioTermino'],
            $dados['funcionario']
        );

        // Salvar reserva no banco de dados
        $this->reservaRepo->salvarReserva($reserva);

        // Atualizar o status da mesa para não disponível
        $this->mesaRepo->atualizarStatusMesa($dados['mesa'], false);

        return $res->json(['status' => 'success', 'message' => 'Reserva realizada com sucesso']);
    }

    public function listarReservas($req, $res)
    {
        $reservas = $this->reservaRepo->listarReservas();
        return $res->json($reservas);  // Retorna as reservas como JSON
    }


    public function cancelarReserva($req, $res)
    {
        $id = $req->param('id');
        $this->reservaRepo->cancelarReserva($id);

        // Update table status
        $stmt = $this->pdo->prepare("SELECT mesa FROM reservas WHERE id = ?");
        $stmt->execute([$id]);
        $mesa = $stmt->fetchColumn();
        $this->mesaRepo->atualizarStatusMesa($mesa, true);

        return $res->json(['status' => 'success', 'message' => 'Reserva cancelada']);
    }
}
