<?php

class EImmagine{

    private $id;
    private $nome;
    private $dimensione;
    private $tipo;
    private $immagine;

    /**
     * @param $id
     * @param $nome
     * @param $dimensione
     * @param $tipo
     * @param $immagine
     */
    public function __construct($id=null, $nome=null, $dimensione=null, $tipo=null, $immagine=null)
    {
        $this->id = $id;
        $this->nome = $nome;
        $this->dimensione = $dimensione;
        $this->tipo = $tipo;
        $this->immagine = $immagine;
    }


    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

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
     * Get the value of dimensione
     */ 
    public function getDimensione()
    {
        return $this->dimensione;
    }

    /**
     * Set the value of dimensione
     *
     * @return  self
     */ 
    public function setDimensione($dimensione)
    {
        $this->dimensione = $dimensione;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of immagine
     */ 
    public function getImmagine()
    {
        return $this->immagine;
    }

    /**
     * Set the value of immagine
     *
     * @return  self
     */ 
    public function setImmagine($immagine)
    {
        $this->immagine = $immagine;

        return $this;
    }
}

?>