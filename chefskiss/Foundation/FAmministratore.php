<?php 

class FModeratore extends Fdb{
    function __construct() {
        $this->_table='amministratore';
        $this->_key='id_amm';
        $this->_auto_increment=true;
        $this->_return_class='EAmministratore';
        USingleton::getInstance('Fdb');
    }
}

?>