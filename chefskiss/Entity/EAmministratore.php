<?php


class EAmministratore
{
    private $id;

    /**
     * @param $id
     */
    public function __construct($id=null)
    {
        $this->id = $id;
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
}