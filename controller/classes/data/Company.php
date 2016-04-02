<?php
/**
 *  This class handles all the data you can get from a Company
 *
 *	@package TMDB-V3-PHP-API
 *  @author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 *  @version 0.1
 *  @date 11/01/2015
 *  @link https://github.com/Alvaroctal/TMDB-PHP-API
 *  @copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Company {

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Company
     */
    public function __construct($data) {
        $this->_data = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Company's name
     *
     *  @return string
     */
    public function getName() {
        return $this->_data['name'];
    }

    /** 
     *  Get the Company's id
     *
     *  @return int
     */
    public function getID() {
        return $this->_data['id'];
    }

    /** 
     *  Get the Company's description
     *
     *  @return string
     */
    public function getDescription() {
        return $this->_data['description'];
    }

    /** 
     *  Get the Company's headquearters
     *
     *  @return string
     */
    public function getHeadquarters() {
        return $this->_data['headquarters'];
    }

    /** 
     *  Get the Company's homepage
     *
     *  @return string
     */
    public function getHomepage() {
        return $this->_data['homepage'];
    }

    /** 
     *  Get the Company's logo
     *
     *  @return string
     */
    public function getLogo() {
        return $this->_data['logo_path'];
    }

    /** 
     *  Get the Company's parent company id
     *
     *  @return int
     */
    public function getParentCompanyID() {
        return $this->_data['parent_company'];
    }

    /**
     *  Get the Company's Movies
     *
     *  @return Movie[]
     */
    public function getMovies() {
        $movies = array();

        foreach($this->_data['movies']['results'] as $data){
            $movies[] = new Movie($data);
        }

        return $movies;
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
     *  Get the JSON representation of the Movie
     *
     *  @return string
     */
    public function getJSON() {
        return json_encode($this->_data, JSON_PRETTY_PRINT);
    }
}
?>