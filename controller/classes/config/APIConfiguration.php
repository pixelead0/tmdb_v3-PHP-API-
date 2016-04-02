<?php
/**
 *  This class handles all the data you can get from the api Configuration
 *
 *	@package TMDB_V3_API_PHP
 *  @author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 *  @version 0.1
 *  @date 20/01/2015
 *  @link https://github.com/Alvaroctal/TMDB-PHP-API
 *  @copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class APIConfiguration {

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Configuration
     */
    public function __construct($data) {
        $this->_data = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Configuration's base URL for images
     *
     *  @return string
     */
    public function getImageBaseURL() {
        return $this->_data['images']['base_url'];
    }

    /** 
     *  Get the Configuration's secure base URL for images
     *
     *  @return string
     */
    public function getSecureImageBaseURL() {
        return $this->_data['images']['secure_base_url'];
    }

    /** 
     *  Get the Configuration's list of sizes for backdrops
     *
     *  @return string[]
     */
    public function getBackdropSizes() {
        return $this->_data['images']['backdrop_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for logos
     *
     *  @return string[]
     */
    public function getLogoSizes() {
        return $this->_data['images']['logo_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for posters
     *
     *  @return string[]
     */
    public function getPosterSizes() {
        return $this->_data['images']['poster_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for profiles
     *
     *  @return string[]
     */
    public function getProfileSizes() {
        return $this->_data['images']['profile_sizes'];
    }

    /** 
     *  Get the Configuration's list of sizes for stills
     *
     *  @return string[]
     */
    public function getStillSizes() {
        return $this->_data['images']['still_sizes'];
    }

    /**
     *  Get Generic.<br>
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     *  @param string $item The item of the $data array you want
     *  @return array
     */
    public function get($item = '') {
        return (empty($item)) ? $this->_data : $this->_data[$item];
    }

    //------------------------------------------------------------------------------
    // Export
    //------------------------------------------------------------------------------

    /** 
     *  Get the JSON representation of the Configuration
     *
     *  @return string
     */
    public function getJSON() {
        return json_encode($this->_data, JSON_PRETTY_PRINT);
    }
}
?>