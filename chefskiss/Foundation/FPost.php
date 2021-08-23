<?php 

class FPost extends Fdb{
    function __construct() {
        $this->_table='post';
        $this->_key='id';
        $this->_auto_increment=true;
        $this->_return_class='EPost';
        USingleton::getInstance('Fdb');
    }
    
    public function insert($post) {
        parent::insert($post);
        $FCommento=new FCommento();
        $arrayCommentiEsistenti=$FCommento->loadCommenti($post->id);
        if ($arrayCommentiEsistenti != false) {
            foreach ($arrayCommentiEsistenti as $itemCommento) {
                $FCommento->delete($itemCommento);
            }
        }
        $arrayCommenti=$post->getCommenti();
        foreach ($arrayCommenti as $commento) {
            $commento->id=$post->id;
            $FCommento->store($commento);
        }
    }
    
    public function load ($id): array {
        $post=parent::load($id);
        $FCommento=new FCommento();
        $arrayCommenti=$FCommento->loadCommenti($post->id);
        $post->_commento=$arrayCommenti;
        return $post;
    }
    
    public function filterByCategorie(String $categoria){
        $query='SELECT * FROM post WHERE categoria:= ' .
            $categoria;
        $this->query($query);
        return $this->execQuery();
    }
}

?>