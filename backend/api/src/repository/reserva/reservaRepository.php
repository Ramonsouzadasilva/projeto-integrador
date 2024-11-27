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

    public function verificarDisponibilidade($mesa, $data, $horaInicial, $horaTermino)
    {
        // Preparamos a consulta para verificar a disponibilidade da mesa
        $stmt = $this->pdo->prepare("
            SELECT * FROM reserva
            WHERE mesa = :mesa
            AND (
                (data_reservada = :data AND inicio_reserva BETWEEN :inicio AND :fim)
                OR
                (data_reservada = :data AND fim_reserva BETWEEN :inicio AND :fim)
            )
        ");

        // Executamos a consulta passando os parâmetros nomeados
        $stmt->execute([
            ':mesa' => $mesa,
            ':data' => $data,
            ':inicio' => $horaInicial,
            ':fim' => $horaTermino
        ]);

        // Verificamos se existem registros que indicam conflito de reserva
        return $stmt->rowCount() > 0;
    }


    public function salvarReserva(Reserva $reserva)
    {
        $stmt = $this->pdo->prepare("INSERT INTO reserva (nome_cliente, data_reservada, inicio_reserva, 
        fim_reserva, mesa, funcionario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $reserva->nomeCliente,
            $reserva->data,
            $reserva->horaInicial,
            $reserva->horaTermino,
            $reserva->mesa,
            $reserva->funcionario
        ]);
    }

    public function cancelarReserva($id)
    {
        $stmt = $this->pdo->prepare("UPDATE reserva SET status = 'cancelada' WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function listarReservas()
    {
        $stmt = $this->pdo->query("SELECT * FROM reserva WHERE inicio_reserva >= NOW() ORDER BY inicio_reserva ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Usando fetchAll(PDO::FETCH_ASSOC)
    }
}
