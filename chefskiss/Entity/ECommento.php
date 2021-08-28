<?php

class ECommento {
    private String $autore;
    private String $testo;
    private int $id_post;
    private int $id;
    private DateTime $data;

    /**
     * ECommento constructor.
     */
    public function __construct(){}

    public function parseparam(){
        return[
            'autore' => $this->getAutore(),
            'testo' => $this->getTesto(),
            'id' => $this->getId(),
            'id_post' => $this->getId_post(),
            'data_pubblicazione' => $this->getData(),
    ];

    }

    /**
     * Get the value of data
     */ 
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set the value of data
     *
     * @return  self
     */ 
    public function setData($data)
    {
        $this->data = $data;

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

    /**
     * Get the value of id_post
     */ 
    public function getId_post()
    {
        return $this->id_post;
    }

    /**
     * Set the value of id_post
     *
     * @return  self
     */ 
    public function setId_post($id_post)
    {
        $this->id_post = $id_post;

        return $this;
    }

    /**
     * Get the value of testo
     */ 
    public function getTesto()
    {
        return $this->testo;
    }

    /**
     * Set the value of testo
     *
     * @return  self
     */ 
    public function setTesto($testo)
    {
        $this->testo = $testo;

        return $this;
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
}
?>
