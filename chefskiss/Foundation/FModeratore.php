<?php 

class FModeratore extends Fdb{
    function __construct() {
        $this->_table='moderatore';
        $this->_key='id_mod';
        $this->_auto_increment=true;
        $this->_return_class='EModeratore';
        USingleton::getInstance('Fdb');
    }
}

?>