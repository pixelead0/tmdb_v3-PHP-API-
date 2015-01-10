<?php
/**
 * Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 * @date 09/01/2015
 * @version 0.1
 * @author Alvaro Octal | https://twitter.com/Alvaro_Octal
 * @link https://github.com/Alvaroctal/TMDB-PHP-API
 */

class Movie{

	//------------------------------------------------------------------------------
	// Class Variables
	//------------------------------------------------------------------------------

	private $_data;

	/**
	 * 	Construct Class
	 *
	 * 	@param string json A json representation of the Movie
	 */
	public function  __construct($json) {
		$this->_data = json_decode($json, true);
	}

	/** 
	 * 	Get the Movie's id
	 *
	 * 	@return int
	 */
	public function getID() {
		return $this->_data['id'];
	}

	/** 
	 * 	Get the Movie's title
	 *
	 * 	@return string
	 */
	public function getTitle() {
		return $this->_data['title'];
	}

	/** 
	 * 	Get the Movie's tagline
	 *
	 * 	@return string
	 */
	public function getTagline() {
		return $this->_data['tagline'];
	}

	/** 
	 * 	Get the Movie's Poster
	 *
	 * 	@return string
	 */
	public function getPoster() {
		return $this->_data['poster_path'];
	}

	/** 
	 * 	Get the Movie's vote average
	 *
	 * 	@return int
	 */
	public function getVoteAverage() {
		return $this->_data['vote_average'];
	}

	/** 
	 * 	Get the Movie's vote count
	 *
	 * 	@return int
	 */
	public function getVoteCount() {
		return $this->_data['vote_count'];
	}

	/** 
	 * 	Get the Movie's trailers
	 *
	 * 	@return array
	 */
	public function getTrailers() {
		return $this->_data['trailers'];
	}

	/** 
	 * 	Get the Movie's trailer
	 *
	 * 	@return string
	 */
	public function getTrailer() {
		return $this->_data['trailers']['youtube'][0]['source'];
	}

	/** 
	 * 	Get the JSON representation of the Movie
	 *
	 * 	@return string
	 */
	public function getJSON() {
		return json_encode($this->_data, JSON_PRETTY_PRINT);
	}
}
?>