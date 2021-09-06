<?php

require_once 'StartSmarty.php';
require_once 'autoload.php';

$array = explode('/', $_SERVER['REQUEST_URI']);
array_shift($array);

array_shift($array);
//array_shift($array);

$fcontroller = new CFrontController();
$fcontroller->run($_SERVER['REQUEST_URI']);
