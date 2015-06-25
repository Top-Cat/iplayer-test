<?php
/**
 * The HTTP API wrapper
 *
 * @author Thomas Cheyney <thomas@thomasc.co.uk>
 * @version 20150625
 */
class BBC_Api {

	/** @var string Base URI of the HTTP API */
	const API_BASE = 'https://ibl.api.bbci.co.uk/ibl/v1/atoz/';

	/** @var string The letter parameter for the API */
	private $letter;
	/** @var integer The page parameter for the API */
	private $page;

	/** @var string The constructed URL used when calling the API */
	private $url;
	/** @var object The response from the API */
	private $json;

	/** @var BBC_Programme[] List of programmes in this response */
	private $programmes;

	/**
	 * BBC_Api Constructor
	 * Constructs the URL that will be called later
	 * 
	 * @param string	$letter	The letter parameter for the API
	 * @param integer	$page		The page parameter for the API
	 */
	function __construct($letter, $page) {
		$this->letter = urlencode($letter);
		$this->page = urlencode($page);

		$this->url = self::API_BASE. $letter . '/programmes?page=' . $page;
	}

	/**
	 * Makes the API call, allows other class functions to be called
	 * @return null Nothing
	 */
	function doCall() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		curl_close($ch);

		$this->json = json_decode($result)->atoz_programmes;
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
		return ceil($this->json->count / $this->json->per_page);
	}

}