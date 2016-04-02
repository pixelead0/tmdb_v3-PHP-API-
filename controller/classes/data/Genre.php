<?php
/**
 *  This class handles all the data you can get from a Genre
 *
 *	@package TMDB-V3-PHP-API
 *  @author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 *  @version 0.1
 *  @date 11/01/2015
 *  @link https://github.com/Alvaroctal/TMDB-PHP-API
 *  @copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Genre {

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_data;

    /**
     *  Construct Class
     *
     *  @param array $data An array with the data of a Collection
     */
    public function __construct($data) {
        $this->_data = $data;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Genre's name
     *
     *  @return string
     */
    public function getName() {
        return $this->_data['name'];
    }

    /** 
     *  Get the Genre's id
     *
     *  @return int
     */
    public function getID() {
        return $this->_data['id'];
    }
}
?>