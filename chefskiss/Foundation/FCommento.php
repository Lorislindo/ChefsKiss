<?php 

class FCommento extends Fdb{
    public function __construct(){
        $this->_table='commento';
        $this->_key='id';
        $this->_auto_increment=true;
        $this->_return_class='ECommento';
        USingleton::getInstance('Fdb');
    }
    
    public function insert( $object){
        $id = parent::insert($object);
        $object->id=$id;
    }
    
    public function loadCommenti($post){
        $parametri=array();
        $parametri[]=array('post','=',$post);
        $arrayCommenti=parent::search($parametri);  //MANCA METODO SEARCH SU Fdb
        return $arrayCommenti;
    }

}

?>