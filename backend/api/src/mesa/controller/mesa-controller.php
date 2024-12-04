<?php
require_once 'src/mesa/repositorio/mesa-repositorio.php';

class MesaController
{
    protected MesaRepository $mesaRepo;
    protected PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
        $this->mesaRepo = new MesaRepository($pdo);
    }

    public function listarMesas($req, $res)
    {
        $mesas = $this->mesaRepo->listarMesas();
        return $res->json($mesas);
    }
}
