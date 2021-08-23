<?php

class FRicetta extends Fdb {


    public function __construct(){
        $this->_table='ricetta';
        $this->_key='id';
        $this->_auto_increment=true;
        $this->_return_class='Ericetta';
        USingleton::getInstance('Fdb');
    }

    public function insert($ricetta){
        parent::insert($ricetta);
        $FRecensione=new FRecensione();
        $FImmagine=new FImmagine();
        $arrayRecensioniEsistenti=$FRecensione->loadRecensioni($ricetta->id);
        $arrayImmaginiEsistenti=$FImmagine->loadImmagini($ricetta->id);
        if ($arrayRecensioniEsistenti != false) {
            foreach ($arrayRecensioniEsistenti as $item) {
                $FRecensione->remove($item);
            }
        }
        $arrayRecensioni=$ricetta->getRecensioni();
        foreach ($arrayRecensioni as $recensione) {
            $recensione->id=$ricetta->id;
            $FRecensione->insert($recensione);
        }
        if ($arrayImmaginiEsistenti != false) {
            foreach ($arrayImmaginiEsistenti as $item) {
                $FImmagine->remove($item);
            }
        }
        $arrayImmagini=$ricetta->getRecensioni();
        foreach ($arrayImmagini as $immagine) {
            $immagine->id=$ricetta->id;
            $FImmagine->insert($immagine);
        }
    }

    public function load($id): array {
        $ricetta=parent::load($id);
        $FRecensione=new FRecensione();
        $arrayRecensioni=$FRecensione->loadRecensioni($ricetta);
        $ricetta[0]->_recensione=$arrayRecensioni;
        return $ricetta;
    }

    public function filterByCategorie(String $categoria){
        $query='SELECT * FROM post WHERE categoria:= ' .
            $categoria;
        $this->createStatement($query);
        return $this->execStatement();
    }

}