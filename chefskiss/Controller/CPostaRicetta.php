<?php

class CPostaRicetta{

    private $_ricetta;

    public function formRicetta(){
        $view = USingleton::getInstance(VRicetta);
        $id_ricetta = $view->getId();


    }

    public function datiRicetta(){

    }


}
