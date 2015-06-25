<?php

abstract class Test_Test {

	protected $passed = true;

	abstract protected function doTest();

	abstract protected function getName();

	public function run() {
		print "Testing " . $this->getName() . " ... ";
		$this->doTest();
		print ($this->passed ? "PASSED" : "FAILED") . NEWLINE;

		return $this->passed;
	}

	protected function assertEquals($a, $b) {
		$this->passed &= $a === $b;
	}

}

?>