<?php

class VUtente
{

    private $smarty;

    public function __construct()
    {
        $this->smarty = StartSmarty::configuration();
    }

    public function showFormLogin(){
        $this->smarty->display('login_form.tpl');
    }

    public function loginOk(){
        $this->smarty->display('index.tpl');
    }

    public function loginErr(){
        $this->smarty->assign('error', "errore");
        $this->smarty->display('login.tpl');
    }


}