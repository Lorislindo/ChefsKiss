<?php

class ECommento {
    private $autore;
    private $testo;
    private $id_post;
    private $id;
    private $data;

    /**
     * ECommento constructor.
     * @param $autore
     * @param $testo
     * @param $id_post
     * @param $id
     * @param $data
     */
    public function __construct($autore, $testo, $id_post, $id, $data)
    {
        $this->autore = $autore;
        $this->testo = $testo;
        $this->id_post = $id_post;
        $this->id = $id;
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getAutore()
    {
        return $this->autore;
    }

    /**
     * @param mixed $autore
     */
    public function setAutore($autore): void
    {
        $this->autore = $autore;
    }

    /**
     * @return mixed
     */
    public function getTesto()
    {
        return $this->testo;
    }

    /**
     * @param mixed $testo
     */
    public function setTesto($testo): void
    {
        $this->testo = $testo;
    }

    /**
     * @return mixed
     */
    public function getIdPost()
    {
        return $this->id_post;
    }

    /**
     * @param mixed $id_post
     */
    public function setIdPost($id_post): void
    {
        $this->id_post = $id_post;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }


}
?>
