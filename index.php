<?php

spl_autoload_register(function ($classname) {
	include str_replace('_', '/', $classname) . '.php';
});

$bbc = new BBC_Api('a', 1);
print_r($bbc->getProgrammes());

?>
