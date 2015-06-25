<?php

class BBC_Programme {

	private $title;

	function __construct($json) {
		$this->title = $json->initial_children[0]->title;
		$this->image = str_replace("{recipe}", "240x135", $json->initial_children[0]->images->standard);
	}

}