<?php
class CadeiraCadeira{
    private $idCadeira, $idPreRequisito;
    
    public function __construct($idCadeira, $idPreRequisito){
        $this->idCadeira = $idCadeira;
        $this->idPreRequisito = $idPreRequisito;
    }

    /**
     * Get the value of idCadeira
     */ 
    public function getIdCadeira()
    {
        return $this->idCadeira;
    }

    /**
     * Get the value of idPreRequisito
     */ 
    public function getIdPreRequisito()
    {
        return $this->idPreRequisito;
    }
}
