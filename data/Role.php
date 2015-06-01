<?php
/**
 * 	This class handles all the data you can get from a Role
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Role extends TMDBObject {

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of a Role
     */
    public function __construct($data, $ipPerson) {
        parent::__construct( $data );
        $this->_data['person_id'] = $person_id;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Role's character
     *
     *  @return string
     */
    public function getCharacter() {
        return $this->_data['character'];
    }

    /** 
     *  Get the Movie's poster
     *
     *  @return string
     */
    public function getPoster() {
        return $this->_data['poster_path'];
    }
}
?>