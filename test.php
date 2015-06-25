<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up class loading
spl_autoload_register(function ($classname) {
	include str_replace('_', '/', $classname) . '.php';
});

// Run the tests
$tests = [new Test_Programme(), new Test_Pages(), new Test_Endpoint()];
foreach ($tests as $test) {
	$test->run();
}

?>