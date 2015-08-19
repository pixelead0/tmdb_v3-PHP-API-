<?php
/**
 * 	This class handles all the data you can get from a Person
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Person extends TMDBObject {

    /** 
     *  Get the Person's profile image
     *
     *  @return string
     */
    public function getProfile() {
        return $this->_data['profile_path'];
    }

    /** 
     *  Get the Person's birthday
     *
     *  @return string
     */
    public function getBirthday() {
        return $this->_data['birthday'];
    }

    /** 
     *  Get the Person's place of birth
     *
     *  @return string
     */
    public function getPlaceOfBirth() {
        return $this->_data['place_of_birth'];
    }

    /** 
     *  Get the Person's imdb id
     *
     *  @return string
     */
    public function getImbdID() {
        return $this->_data['imdb_id'];
    }

    /** 
     *  Get the Person's popularity
     *
     *  @return int
     */
    public function getPopularity() {
        return $this->_data['popularity'];
    }

    /**
     *  Get the Person's MovieRoles
     *
     *  @return MovieRole[]
     */
    public function getMovieRoles() {
        $movieRoles = array();

        foreach($this->_data['movie_credits']['cast'] as $data){
            $movieRoles[] = new MovieRole($data, $this->getID());
        }

        return $movieRoles;
    }

    /**
     *  Get the Person's TVShowRoles
     *
     *  @return TVShowRole[]
     */
    public function getTVShowRoles() {
        $tvShowRole = array();

        foreach($this->_data['tv_credits']['cast'] as $data){
            $tvShowRole[] = new TVShowRole($data, $this->getID());
        }

        return $tvShowRole;
    }
	
	/** 
     *  Get the Person's biography
     *
     *  @return string
     */
    public function getBiography() {
        return $this->_data['biography'];
    }
	
	/** 
     *  Get the Person's deathday
     *
     *  @return string
     */
    public function getDeathday() {
        return $this->_data['deathday'];
    }
	
	//------------------------------------------------------------------------------
    // Load
    //------------------------------------------------------------------------------

    /**
     *  Reload the content of this class.<br>
     *  Could be used to update or complete the information.
     *  
     *  @param TMDB $tmdb An instance of the API handler, necesary to make the API call.
     */
    public function reload($tmdb) {
       return $tmdb->getPerson($this->getID());
    }
}
?>