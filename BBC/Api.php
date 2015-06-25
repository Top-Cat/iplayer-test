<?php
/**
 * The HTTP API wrapper
 */
class BBC_Api {

	/** @var string Base URI of the HTTP API */
	const API_BASE = 'https://ibl.api.bbci.co.uk/ibl/v1/atoz/';

	/** @var string The letter parameter for the API */
	private $letter;
	/** @var integer The page parameter for the API */
	private $page;

	/** @var object The response from the API */
	private $json;
	/** @var boolean True if we got a valid response from the API */
	private $success;

	/** @var BBC_Programme[] List of programmes in this response */
	private $programmes;

	/**
	 * BBC_Api Constructor
	 * Constructs a URL and calls the API
	 * 
	 * @param string	$letter	The letter parameter for the API
	 * @param integer	$page		The page parameter for the API
	 */
	function __construct($letter, $page) {
		$this->letter = urlencode($letter);
		$this->page = urlencode($page);

		$url = self::API_BASE . $letter . '/programmes?page=' . $page;

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = json_decode(curl_exec($ch));
		curl_close($ch);

		$this->success = isset($result) && !isset($result->error);

		if ($this->success) {
			$this->json = $result->atoz_programmes;
		}
	}

	/**
	 * Checks if this API call was successful
	 * @return boolean True if we got a valid response from the API
	 */
	function getSuccess() {
		return $this->success;
	}

	/**
	 * Gets the list of programmes from the API
	 * @return BBC_Programme[]	The programmes
	 */
	function getProgrammes() {
		if (!isset($this->programmes)) {
			$elems = $this->json->elements;
			foreach ($elems as $elem) {
				$this->programmes[] = new BBC_Programme($elem);
			}
		}

		return $this->programmes;
	}

	/**
	 * Gets the number of pages of programmes for the current letter
	 * @return integer	The count
	 */
	function getPageCount() {
		return (int) max(ceil($this->json->count / $this->json->per_page), 1);
	}

}