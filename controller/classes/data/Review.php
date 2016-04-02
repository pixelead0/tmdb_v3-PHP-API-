<?php
/**
 *  This class handles all the data you can get from a Review
 *
 *	@package TMDB-V3-PHP-API
 *  @author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 *  @version 0.1
 *  @date 31/03/2016
 *  @link https://github.com/Alvaroctal/TMDB-PHP-API
 *  @copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Review {

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Review
     */
    public function __construct($data) {
        $this->_data = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Review's id
     *
     *  @return int
     **/
    public function getID() {
        return $this->_data['id'];
    }

    /** 
     *  Get the Review's author
     *
     *  @return string
     */
    public function getAuthor() {
        return $this->_data['author'];
    }

    /** 
     *  Get the Review's content
     *
     *  @return string
     */
    public function getContent() {
        return $this->_data['content'];
    }

    /** 
     *  Get the Review's url
     *
     *  @return string
     */
    public function getURL() {
        return $this->_data['url'];
    }

    /**
     *  Get Generic.<br>
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     *  @param string $item The item of the $data array you want
     *  @return array
     */
    public function get($item = ''){
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