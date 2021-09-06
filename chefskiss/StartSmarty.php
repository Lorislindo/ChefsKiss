<?php

require_once ('./smarty/libs/Smarty.class.php');

class StartSmarty
{
    static function configuration(){
        $smarty=new Smarty();
        $smarty->template_dir= $_SERVER['DOCUMENT_ROOT'].'/templates';
        $smarty->compile_dir= $_SERVER['DOCUMENT_ROOT'].'/templates_c';
        $smarty->config_dir=$_SERVER['DOCUMENT_ROOT'].'/configs';
        $smarty->cache_dir=$_SERVER['DOCUMENT_ROOT'].'/cache';
        return $smarty;
    }
}