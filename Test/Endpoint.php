<?php

class Test_Endpoint extends Test_Test {

	function getName() {
		return "Endpoint";
	}

	function doTest() {
		$bbc = new BBC_Api('-', 1);
		self::assertEquals($bbc->doCall(), false);

		$bbc = new BBC_Api('a', 1);
		self::assertEquals($bbc->doCall(), true);
	}

}

?>