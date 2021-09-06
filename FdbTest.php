<?php

require 'chefskiss/Entity/EUtente.php';
require 'chefskiss/Foundation/FUtente.php';
require 'chefskiss/Foundation/FCommento.php';
require 'chefskiss/Entity/ECommento.php';
require 'chefskiss/Foundation/FPersistentManager.php';

class FdbTest
{

    public function testDelete()
    {
        $pm = USingleton::getInstance('FPersistentManager');
        $pm::delete('id', 13, 'FCommento');
    }

    public function testGetResult()
    {

    }

    public function testGetObject()
    {

    }

    public function testInsert()
    {
        $commento = new ECommento();
        //$commento->setId(2);
        $commento->setAutore(1);
        $commento->setData(date('y-m-d'));
        $commento->setId_post(1);
        $commento->setTesto('testo di prova 6');
        $pm = USingleton::getInstance('FPersistentManager');
        $pm::insert($commento);
    }

    public function testClose()
    {

    }

    public function testSearch()
    {
        $pm = USingleton::getInstance('FPersistentManager');
        $parametri = array();
        $parametri[] = array('testo', '=', 'testo prova 2');
        $ricerca = $pm::search('Fcommento', $parametri);
        return $ricerca;
    }

    public function testLoad()
    {
     $pm = USingleton::getInstance('FPersistentManager');
     $commento = $pm::load('`id`', 3, 'FCommento');
     return $commento;
    }

    public function testGetArrayObject()
    {

    }

    public function testUpdate(){
        $pm = USingleton::getInstance('FPersistentManager');
        $pm::update('testo', 'testo di prova 46', 'id', '13', 'FCommento');
    }
}

$ft = new FdbTest();
//$ft->testInsert();
//$ft->testDelete();
//$ft->testUpdate();
var_dump($ft->testSearch());
foreach ($ft->testSearch()[0] as $key => $value) {
    echo $key;
}
var_dump($ft->testLoad());
