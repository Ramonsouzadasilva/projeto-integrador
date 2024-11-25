<?php


class Mesa
{
    public $id;
    public $disponivel;

    public function __construct($id, $disponivel)
    {
        $this->id = $id;
        $this->disponivel = $disponivel;
    }
}
