<?php

class BBC_Api {

	const API_BASE = 'https://ibl.api.bbci.co.uk';

	private $letter;
	private $page;

	private $url;
	private $json;

	private $prog_count = 0;
	private $programmes = [];

	function __construct($letter, $page) {
		$this->letter = $letter;
		$this->page = $page;

		$this->url = self::API_BASE.'/ibl/v1/atoz/' . $letter . '/programmes?page=' . $page;
		$this->doCall();
	}

	function doCall() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		$this->json = json_decode($result);
		$this->process();
	}

	function process() {
		$this->prog_count = $this->json->atoz_programmes->count;

		$elems = $this->json->atoz_programmes->elements;
		foreach ($elems as $elem) {
			$this->programmes[] = new BBC_Programme($elem);
		}
	}

	function getProgrammes() {
		return $this->programmes;
	}

	function getPageCount() {
		return ceil($this->prog_count / 20);
	}

	function getCurrentPage() {
		return $this->page;
	}

}