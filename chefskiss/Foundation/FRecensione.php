<?php

class FRecensione extends Fdb{
    public function __construct(){
        $this->_table='recensione';
        $this->_key='id';
        $this->_auto_increment=true;
        $this->_return_class='Erecensione';
        USingleton::getInstance('Fdb');

    }

    public function insert($recensione)
    {
        $id = parent::insert($recensione);
        $recensione->id=$id;
    }


    public function loadRecensioni($recensione)
    {
        $parametri=array();
        $parametri[]=array('recensione','=',$recensione);
        $arrayRecensioni=parent::search($parametri);
        return $arrayRecensioni;
    }






}

?>
