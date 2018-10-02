<?php

require_once '../vendor/autoload.php';

$titi = new App\Wcs\Hello();

echo $titi->talk() . '<br>';

$tutu = new HelloWorld\SayHello();

echo $tutu->world();
