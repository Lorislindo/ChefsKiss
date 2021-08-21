<?php

class FUtente extends Fdb{

    public function __construct(){
        $this->_return_table='utente';
        $this->_key='id';
        $this->_return_class='EUtente';
        USingleton::getInstance('Fdb');
    }
}
?>