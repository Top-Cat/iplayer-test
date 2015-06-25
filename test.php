<?php

define('NEWLINE', php_sapi_name() == 'cli' ? PHP_EOL : "<br />");

// Set up class loading
spl_autoload_register(function ($classname) {
	include str_replace('_', '/', $classname) . '.php';
});

// Run the tests
$tests = [new Test_Programme(), new Test_Pages(), new Test_Endpoint()];
$test_success = 0;
$test_error = 0;

foreach ($tests as $test) {
	try {
		$test_success += $test->run() ? 1 : 0;
	} catch (Exception $e) {
		$test_error += 1;
	}
}

print NEWLINE . "Tests run: " . count($tests) . ", Failures: " . (count($tests) - $test_success) . ", Errors: " . $test_error . NEWLINE;

?>