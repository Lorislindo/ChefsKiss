<?php

class Ericetta
{
    
    private $ingredienti;
    private $procedimento;
    private $id;
    private $categoria;
    private $data_pubblicazione;
    private $recensioni;
    private $autore;
    private $foto;

    /**
     * @param string $ingredienti
     * @param string $procedimento
     * @param int $id
     * @param string $categoria
     * @param DateTime $data_pubblicazione
     * @param array $recensioni
     * @param int $autore
     * @param array $foto
     */
    public function __construct($ingredienti=null, $procedimento=null, $id=null, $categoria=null, $data_pubblicazione=null, $recensioni=null, $autore=null, $foto=null)
    {
        $this->ingredienti = $ingredienti;
        $this->procedimento = $procedimento;
        $this->id = $id;
        $this->categoria = $categoria;
        $this->data_pubblicazione = $data_pubblicazione;
        $this->recensioni = $recensioni;
        $this->autore = $autore;
        $this->foto = $foto;
    }


    public function addComment(Erecensione $recensione){
        array_push($this ->
            recensioni, $recensione);
    }
    
    public function removeComment(Erecensione $recensione){
        unset($this->recensioni[key($recensione)]);
        array_values($this->recensioni);
        
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
    public function getRecensioni()
    {
        return $this->recensioni;
    }

    /**
     * @return mixed
     */
    public function getAutore()
    {
        return $this->autore;
    }

    /**
     * @return mixed
     */
    public function getFoto()
    {
        return $this->foto;
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
     * @param mixed $recensioni
     */
    public function setRecensioni($recensioni)
    {
        $this->recensioni = $recensioni;
    }

    /**
     * @param mixed $autore
     */
    public function setAutore($autore)
    {
        $this->autore = $autore;
    }

    /**
     * @param mixed $foto
     */
    public function setFoto($foto)
    {
        $this->foto = $foto;
    }

    public function parseparam(){
        return[
            'ingredienti' => $this->getIngredienti(),
            'procedimento' => $this->getProcedimento(),
            'id' => $this->getId(),
            'categoria' => $this->getCategoria(),
            'data_pubblicazione' => $this->getData_pubblicazione(),
            'recensioni' => $this->getRecensioni(),
            'autore' => $this->getAutore(),
            'foto' => $this->getFoto()
    ];

    }

    
    
}

