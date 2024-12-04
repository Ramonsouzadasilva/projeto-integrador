<?php

class CreateReservaDTO
{
    public string $nomeCliente;
    public int $mesa;
    public string $data;
    public string $horaInicial;
    public int $funcionario;

    public function __construct(
        string $nomeCliente,
        int $mesa,
        string $data,
        string $horaInicial,
        int $funcionario
    ) {
        $this->nomeCliente = $nomeCliente;
        $this->mesa = $mesa;
        $this->data = $data;
        $this->horaInicial = $horaInicial;
        $this->funcionario = $funcionario;
    }
}
