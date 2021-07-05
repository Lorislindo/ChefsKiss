<?php

class Erecensione
{
    
    private string $commento;
    private int $valutazione;
    private int $id;
    private int $id_ricetta;
    private DateTime $data_pubblicazione;
    private string $autore;

    public function __construct(){}
    /**
     * @return mixed
     */
    
    
    public function getCommento()
    {
        return $this->commento;
    }

    /**
     * @return mixed
     */
    public function getValutazione()
    {
        return $this->valutazione;
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
    public function getId_ricetta()
    {
        return $this->id_ricetta;
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
     * @param mixed $commento
     */
    public function setCommento($commento)
    {
        $this->commento = $commento;
    }

    /**
     * @param mixed $valutazione
     */
    public function setValutazione($valutazione)
    {
        $this->valutazione = $valutazione;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $id_ricetta
     */
    public function setId_ricetta($id_ricetta)
    {
        $this->id_ricetta = $id_ricetta;
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

    
    
}

