<?php

class BBC_Programme {

	private $title;

	function __construct($json) {
		$this->title = $json->initial_children[0]->title;
		$this->image = str_replace("{recipe}", "405x228", $json->initial_children[0]->images->standard);
	}

}

class BBC_Api {

	const API_BASE = 'https://ibl.api.bbci.co.uk';
	private $count;
	private $elems = [];

	function __construct($letter, $page) {
		$url = self::API_BASE.'/ibl/v1/atoz/' . $letter . '/programmes?page=' . $page;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		$json = json_decode($result);

		$this->count = $json->atoz_programmes->count;
		$elems = $json->atoz_programmes->elements;
		foreach ($elems as $elem) {
			$this->elems[] = new BBC_Programme($elem);
		}
	}

	function getProgrammes() {
		return $this->elems;
	}

}
$bbc = new BBC_Api('a', 2);
print_r($bbc->getProgrammes());

?>
