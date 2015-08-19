<?php
/**
 * 	This class handles all the data you can get from a TVShowRole
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class TVShowRole extends Role {

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /** 
     *  Get the TVShow's title of the TVShowRole
     *
     *  @return string
     */
    public function getTVShowName() {
        return $this->_data['name'];
    }

    /** 
     *  Get the TVShow's id of the TVShowRole
     *
     *  @return int
     */
    public function getTVShowID() {
        return $this->_data['id'];
    }

    /** 
     *  Get the TVShow's original title of the TVShowRole
     *
     *  @return string
     */
    public function getTVShowOriginalTitle() {
        return $this->_data['original_name'];
    }

    /** 
     *  Get the TVShow's release date of the TVShowRole
     *
     *  @return string
     */
    public function getTVShowFirstAirDate() {
        return $this->_data['first_air_date'];
    }
}
?>