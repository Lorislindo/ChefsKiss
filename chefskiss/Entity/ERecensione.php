<?php

class ERecensione
{
    
    private $commento;
    private $valutazione;
    private $id;
    private $id_ricetta;
    private $data_pubblicazione;
    private $autore;

    /**
     * @param $commento
     * @param $valutazione
     * @param $id
     * @param $id_ricetta
     * @param $data_pubblicazione
     * @param $autore
     */
    public function __construct($commento=null, $valutazione=null, $id=null, $id_ricetta=null, $data_pubblicazione=null, $autore=null)
    {
        $this->commento = $commento;
        $this->valutazione = $valutazione;
        $this->id = $id;
        $this->id_ricetta = $id_ricetta;
        $this->data_pubblicazione = $data_pubblicazione;
        $this->autore = $autore;
    }


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
    public function pareseParam(){
        return[
            'commento' => $this->getCommento(),
            'valutazione' => $this->getValutazione(),
            'id' => $this->getId(),
            'id_ricetta' => $this->getId_ricetta(),
            'data_pubblicazione' => $this->getData_pubblicazione(),
            'autore' =>$this->getAutore()
            ];
    }

    
    
}

