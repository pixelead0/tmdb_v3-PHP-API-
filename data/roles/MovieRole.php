<?php
/**
 * 	This class handles all the data you can get from a MovieRole
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class MovieRole extends Role {

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the Movie's title of the MovieRole
     *
     *  @return string
     */
    public function getMovieTitle() {
        return $this->_data['title'];
    }

    /** 
     *  Get the Movie's id of the MovieRole
     *
     *  @return int
     */
    public function getMovieID() {
        return $this->_data['id'];
    }

    /** 
     *  Get the Movie's original title of the MovieRole
     *
     *  @return string
     */
    public function getMovieOriginalTitle() {
        return $this->_data['original_title'];
    }

    /** 
     *  Get the Movie's release date of the MovieRole
     *
     *  @return string
     */
    public function getMovieReleaseDate() {
        return $this->_data['release_date'];
    }
}
?>