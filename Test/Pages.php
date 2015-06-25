<?php

class Test_Pages extends Test_Test {

	const TEST_JSON = "{\"count\": 69, \"per_page\": 20}";

	function getName() {
		return "Pages";
	}

	function doTest() {
		$bbc = new BBC_Api('a', 1);

		$reflector = new ReflectionClass('BBC_Api');
		$prop = $reflector->getProperty('json');
		$prop->setAccessible(true);
		$prop->setValue($bbc, json_decode(self::TEST_JSON));

		self::assertEquals($bbc->getPageCount(), 4);
	}

}

?>