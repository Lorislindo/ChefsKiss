<?php

class EPost {
    private String $autore;
    private String $domanda;
    private String $categoria;
    private int $id;
    private DateTime $data_pubb;

    public  $_commenti = array();


    public function addComment(ECommento $commento){
        array_push($this ->_commenti, $commento);
        if($this->id != null) $commento->setAutore($this->id);
    }

    public function removeComment(ECommento $commento, $_commenti){
        unset($_commenti[key($commento)]);
        array_values($_commenti);

    }

    public function parseparam(){
        return[
            'autore' => $this->getAutore(),
            'domanda' => $this->getDomanda(),
            'id' => $this->getId(),
            'categoria' => $this->getCategoria(),
            'data_pubblicazione' => $this->getData_pubb(),
    ];

    }
    

    /**
     * Get the value of autore
     */ 
    public function getAutore()
    {
        return $this->autore;
    }

    /**
     * Set the value of autore
     *
     * @return  self
     */ 
    public function setAutore($autore)
    {
        $this->autore = $autore;

        return $this;
    }

    /**
     * Get the value of domanda
     */ 
    public function getDomanda()
    {
        return $this->domanda;
    }

    /**
     * Set the value of domanda
     *
     * @return  self
     */ 
    public function setDomanda($domanda)
    {
        $this->domanda = $domanda;

        return $this;
    }

    /**
     * Get the value of categoria
     */ 
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     *
     * @return  self
     */ 
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of data_pubb
     */ 
    public function getData_pubb()
    {
        return $this->data_pubb;
    }

    /**
     * Set the value of data_pubb
     *
     * @return  self
     */ 
    public function setData_pubb($data_pubb)
    {
        $this->data_pubb = $data_pubb;

        return $this;
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
}
?>