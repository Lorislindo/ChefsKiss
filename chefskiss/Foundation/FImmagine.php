<?php

class FImmagine extends Fdb{
    public function __construct(){
        $this->_table='immagini';
        $this->_key='id';
        $this->_auto_increment=true;
        $this->_return_class='EImmagine';
        USingleton::getInstance('Fdb');

    }

    public function insert($immagine){
        $id = parent::insert($immagine);
        $immagine->id=$id;
    }


    public function loadImmagini($immagine){
        $parametri=array();
        $parametri[]=array('immagine','=',$immagine);
        $arrayImmagini=parent::search($parametri);
        return $arrayImmagini;
    }
}

?>