<?php

class EPost {
    private $autore;
    private $domanda;
    private $categoria;
    private $id;
    private $data_pubb;

    public  $_commenti = array();


    public function addComment(ECommento $commento){
        array_push($this ->_commenti, $commento);
    }

    public function removeComment(ECommento $commento, $_commenti){
        unset($_commenti[key($commento)]);
        array_values($_commenti);

    }


    public function getDomanda()
    {
        return $this->domanda;
    }

    public function setDomanda($domanda)
    {
        $this->domanda = $domanda;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDataPubb()
    {
        return $this->data_pubb;
    }

    public function setDataPubb($data_pubb)
    {
        $this->data_pubb = $data_pubb;
    }

    public function getCommenti()
    {
        return $this->_commenti;
    }

    public function setCommenti($commenti)
    {
        $this->_commenti = $commenti;
    }

    public function getAutore()
    {
        return $this->autore;
    }

    public function setAutore($autore)
    {
        $this->autore = $autore;
    }
}
?>