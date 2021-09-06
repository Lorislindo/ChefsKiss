<?php

class CUtente
{

    static function login (){
        if($_SERVER['REQUEST_METHOD']=="GET"){
            if(static::isLogged()) {
                $pm = new FPersistentManager();
                $view = new VUtente();
                //$result = $pm->loadTrasporti();
                //$view->loginOk($result);
                $view->loginOk();
            }
            else{
                $view=new VUtente();
                $view->showFormLogin();
            }
        }elseif ($_SERVER['REQUEST_METHOD']=="POST")
            static::verifica();
    }

    static function verifica(){
        $view = new VUtente();
        $pm = new FPersistentManager();
        $utente = $pm->loadLogin($_POST['email'], $_POST['password']);
        if ($utente != null && $utente->getBan() != true){
            if (session_status() == PHP_SESSION_NONE){
                $session = USingleton::getInstance('USession');
                $savableData = serialize($utente);
                $privilegi = $utente->getPrivilegi();
                $session->setValue('privilegi', $privilegi);
                $session->setValue('utente', $savableData);
                if ($privilegi == 1){ //accesso con privilegi base (utente)
                    if (isset($_COOKIE['home']))
                        setcookie('home', null, time() - 900, '/');
                    else
                        header('Location: ../chefskiss/');
                }
                else { //accesso con privilegi maggiori (moderatore o amministratore)
                    header('Location: ../Chefskiss/chefskiss/Admin/homepage');
                }
            }
        } else {
            $view->loginErr();
        }
    }

    static function isLogged(){
        $check = false;
        if (isset($_COOKIE['PHPSESSID'])){
            if (session_status() == PHP_SESSION_NONE){
                session_start();
            }
        }
        if (isset($_SESSION['utente'])){
            $check = true;
        }
        return $check;
    }
}