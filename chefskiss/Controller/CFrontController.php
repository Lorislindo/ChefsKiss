<?php

//require_once 'chefskiss/StartSmarty.php';

class CFrontController
{

    public function run($path){


        $resource = explode('/', $path);

        array_shift($resource);
        array_shift($resource);
        array_shift($resource);

        if ($resource[0] != 'api'){

            echo $resource[1];
            $controller = 'C' . $resource[0];
            $dir = 'Controller';
            $elementDir = scandir($dir);

            if (in_array($controller . ".php", $elementDir)) {
                if (isset($resource[1])) {
                    $function = $resource[1];
                    if (method_exists($controller, $function)) {

                        $param = array();
                        for ($i = 2; $i < count($resource); $i++) {
                            $param[] = $resource[$i];
                        }

                        $num = count($param);
                        if ($num == 0) $controller::$function();
                        else if ($num == 1) $controller::$function($param[0]);
                        else if ($num == 2) $controller::$function($param[0], $param[1]);


                    }
                    else {
                        if (CUtente::isLogged()){
                            $utente = unserialize($_SESSION['utente']);
                            if ($utente->getEmail() == 'admin@admin.com'){
                                header('Location: /chefkiss/Admin/homepage');
                            } else {
                                CUtente::login();
                            }
                        } else {
                            CUtente::login();
                        }
                    }
                } else {
                    if (CUtente::isLogged()){
                        $utente = unserialize($_SESSION['utente']);
                        if ($utente->getEmail() == 'admin@admin.com'){
                            header('Location: /chefkiss/Admin/homepage');
                        } else {
                            CUtente::login();
                        }
                    } else {
                        CUtente::login();
                    }
                }
            } else {
                if (CUtente::isLogged()){
                    $utente = unserialize($_SESSION['utente']);
                    if ($utente->getEmail() == 'admin@admin.com'){
                        header('Location: /chefkiss/Admin/homepage');
                    } else {
                        CUtente::login();
                    }
                } else {
                    CUtente::login();
                }
            }
        }
    }

}