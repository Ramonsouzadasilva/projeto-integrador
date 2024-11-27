
<?php

class Reserva
{
    public $id;
    public $nomeCliente;
    public $mesa;
    public $data;
    public $horaInicial;
    public $horaTermino;
    public $funcionario;
    public $status;

    public function __construct($id, $nomeCliente, $mesa, $data, $horaInicial, $horaTermino, $funcionario, $status = 'ativo')
    {
        $this->id = $id;
        $this->nomeCliente = $nomeCliente;
        $this->mesa = $mesa;
        $this->data = $data;
        $this->horaInicial = $horaInicial;
        $this->horaTermino = $horaTermino;
        $this->funcionario = $funcionario;
        $this->status = $status;
    }
}
