<?php

require_once 'src/model/reserva.php';
require_once 'src/model/mesa.php';

class ReservaRepository
{
    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function verificarDisponibilidade($mesa_id, $data_inicio, $hora_inicio, $data_fim, $hora_fim)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM reservas WHERE mesa_id = ? AND ((data = ? AND hora_inicio BETWEEN ? AND ?) OR (data = ? AND hora_fim BETWEEN ? AND ?))");
        $stmt->execute([
            $mesa_id,
            $data_inicio,
            $hora_inicio,
            $hora_fim,
            $data_fim,
            $hora_inicio,
            $hora_fim
        ]);
        return $stmt->rowCount() > 0;
    }

    public function salvarReserva(Reserva $reserva)
    {
        $stmt = $this->pdo->prepare("INSERT INTO reservas (nome_cliente, data, hora_inicio, hora_fim, mesa_id, funcionario_id) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $reserva->clienteNome,
            $reserva->dataHoraInicio,
            $reserva->dataHoraInicio,
            $reserva->dataHoraFim,
            $reserva->mesaId,
            $reserva->funcionarioId
        ]);
    }

    public function cancelarReserva($id)
    {
        $stmt = $this->pdo->prepare("UPDATE reservas SET status = 'cancelada' WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function listarReservas()
    {
        $stmt = $this->pdo->query("SELECT * FROM reservas WHERE data_inicio >= NOW() ORDER BY data_inicio ASC");
        return $stmt->fetchAll();
    }
}
