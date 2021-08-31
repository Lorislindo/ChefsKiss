<?php

class ERicetta
{
    
    private $ingredienti;
    private $procedimento;
    private $id;
    private $categoria;
    private $data_pubblicazione;
    private $autore;

    /**
     * @param string $ingredienti
     * @param string $procedimento
     * @param int $id
     * @param string $categoria
     * @param DateTime $data_pubblicazione
     * @param int $autore
     */
    public function __construct($ingredienti=null, $procedimento=null, $id=null, $categoria=null, $data_pubblicazione=null, $autore=null)
    {
        $this->ingredienti = $ingredienti;
        $this->procedimento = $procedimento;
        $this->categoria = $categoria;
        $this->id = $id;
        $this->data_pubblicazione = $data_pubblicazione;
        $this->autore = $autore;
    }
    
    public function getIngredienti()
    {
        return $this->ingredienti;
    }

    /**
     * @return mixed
     */
    public function getProcedimento()
    {
        return $this->procedimento;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * @return mixed
     */
    public function getData_pubblicazione()
    {
        return $this->data_pubblicazione;
    }

    /**
     * @return mixed
     */
    public function getAutore()
    {
        return $this->autore;
    }

    /**
     * @param mixed $ingredienti
     */
    public function setIngredienti($ingredienti)
    {
        $this->ingredienti = $ingredienti;
    }

    /**
     * @param mixed $procedimento
     */
    public function setProcedimento($procedimento)
    {
        $this->procedimento = $procedimento;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $categoria
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    /**
     * @param mixed $data_pubblicazione
     */
    public function setData_pubblicazione($data_pubblicazione)
    {
        $this->data_pubblicazione = $data_pubblicazione;
    }

    /**
     * @param mixed $autore
     */
    public function setAutore($autore)
    {
        $this->autore = $autore;
    }

    public function parseparam(){
        return[
            'ingredienti' => $this->getIngredienti(),
            'procedimento' => $this->getProcedimento(),
            'id' => $this->getId(),
            'categoria' => $this->getCategoria(),
            'data_pubblicazione' => $this->getData_pubblicazione(),
            'autore' => $this->getAutore(),
        ];

    }

    
    
}

