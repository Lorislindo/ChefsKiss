<?php

require_once 'StartSmarty.php';
require_once 'autoload.php';

echo 'porcop dio';
echo $_SERVER['REQUEST_URI'];

$array = explode('/', $_SERVER['REQUEST_URI']);
array_shift($array);

array_shift($array);
//array_shift($array);

for ($i = 0; $i<count($array); $i++){
    echo $array[$i];
}
$fcontroller = new CFrontController();
$fcontroller->run($_SERVER['REQUEST_URI']);
