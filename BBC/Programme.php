<?php
/**
 * A programme viewable on iPlayer
 */
class BBC_Programme {

	/** @var string Title of the programme */
	private $title;
	/** @var string Url of a thumbnail for the programme */
	private $image;

	/**
	 * BBC_Programme Constructor
	 * @param object	$json	Object with data about this programme
	 */
	function __construct($json) {
		$this->title = $json->initial_children[0]->title;
		$this->image = str_replace("{recipe}", "240x135", $json->initial_children[0]->images->standard);
	}

	/**
	 * Gets the title of this programme
	 * @return string	The title
	 */
	function getTitle() {
		return $this->title;
	}

	/**
	 * Gets a URL to a thumbnail of the programme
	 * @return string	The URL
	 */
	function getImageUrl() {
		return $this->image;
	}

}