<?php
class Cadeira{
    private $idCadeira, $nome, $departamento, $creditos, $codigo, $isEletiva, $grupo, $periodo, $ementa, $preReqs;
    
    public function __construct($idCadeira, $nome, $departamento, $creditos, $codigo, $isEletiva, $grupo, $periodo, $ementa){
        $this->idCadeira = $idCadeira;
        $this->nome = $nome;
        $this->departamento = $departamento;
        $this->creditos = $creditos;
        $this->codigo = $codigo;
        $this->isEletiva = $isEletiva;
        $this->grupo = $grupo;
        $this->periodo =  $periodo;
        $this->ementa = $ementa;
        $this->setPreReqs();
    }

    public function hasPreReqs(){
        return $this->getPreReqs();
    }

    /**
     * Get the value of ementa
     */ 
    public function getEmenta()
    {
        return $this->ementa;
    }

    /**
     * Set the value of ementa
     *
     * @return  self
     */ 
    public function setEmenta($ementa)
    {
        $this->ementa = $ementa;

        return $this;
    }

    /**
     * Get the value of idCadeira
     */ 
    public function getIdCadeira()
    {
        return $this->idCadeira;
    }

    /**
     * Set the value of idCadeira
     *
     * @return  self
     */ 
    public function setIdCadeira($idCadeira)
    {
        $this->idCadeira = $idCadeira;

        return $this;
    }

    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of departamento
     */ 
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * Set the value of departamento
     *
     * @return  self
     */ 
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;

        return $this;
    }

    /**
     * Get the value of creditos
     */ 
    public function getCreditos()
    {
        return $this->creditos;
    }

    /**
     * Set the value of creditos
     *
     * @return  self
     */ 
    public function setCreditos($creditos)
    {
        $this->creditos = $creditos;

        return $this;
    }

    /**
     * Get the value of codigo
     */ 
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * Set the value of codigo
     *
     * @return  self
     */ 
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;

        return $this;
    }

    /**
     * Get the value of isEletiva
     */ 
    public function getIsEletiva()
    {
        return $this->isEletiva;
    }

    /**
     * Set the value of isEletiva
     *
     * @return  self
     */ 
    public function setIsEletiva($isEletiva)
    {
        $this->isEletiva = $isEletiva;

        return $this;
    }

    /**
     * Get the value of grupo
     */ 
    public function getGrupo()
    {
        return $this->grupo;
    }

    /**
     * Set the value of grupo
     *
     * @return  self
     */ 
    public function setGrupo($grupo)
    {
        $this->grupo = $grupo;

        return $this;
    }

    /**
     * Get the value of periodo
     */ 
    public function getPeriodo()
    {
        return $this->periodo;
    }

    /**
     * Set the value of periodo
     *
     * @return  self
     */ 
    public function setPeriodo($periodo)
    {
        $this->periodo = $periodo;

        return $this;
    }

    /**
     * Get the value of preReqs
     */ 
    public function getPreReqs()
    {
        return $this->preReqs;
    }

    /**
     * Set the value of preReqs
     *
     * @return  self
     */ 
    public function setPreReqs()
    {
        $dc = new DAOCadeira();
        $this->preReqs = $dc->getPreReqsByReqId($this->idCadeira);

    }

    public function getPreReqsIds(){
        $r = array();
        foreach($this->getPreReqs() as $cadeira)
            array_push($r, $cadeira->getIdCadeira());

        return $r;
    }

    public function debug(){
        var_dump($this);
    }
}
