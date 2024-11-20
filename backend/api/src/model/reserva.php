
<?php

class Reserva
{
    public $id;
    public $clienteNome;
    public $mesaId;
    public $dataHoraInicio;
    public $dataHoraFim;
    public $funcionarioId;
    public $status;

    public function __construct($id, $clienteNome, $mesaId, $dataHoraInicio, $dataHoraFim, $funcionarioId, $status = 'ativo')
    {
        $this->id = $id;
        $this->clienteNome = $clienteNome;
        $this->mesaId = $mesaId;
        $this->dataHoraInicio = $dataHoraInicio;
        $this->dataHoraFim = $dataHoraFim;
        $this->funcionarioId = $funcionarioId;
        $this->status = $status;
    }
}
