<?php
/**
 * 	This class handles all the data you can get from a Collection
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Collection extends TMDBObject {

    /** 
     *  Get the Collection's overview
     *
     *  @return string
     */
    public function getOverview() {
        return $this->_data['overview'];
    }

    /** 
     *  Get the Collection's poster
     *
     *  @return string
     */
    public function getPoster() {
        return $this->_data['poster_path'];
    }

    /** 
     *  Get the Collection's backdrop
     *
     *  @return string
     */
    public function getBackdrop() {
        return $this->_data['backdrop_path'];
    }

    /**
     *  Get the Collection's Movies
     *
     *  @return Movie[]
     */
    public function getMovies() {
        $movies = array();

        foreach($this->_data['parts'] as $data){
            $movies[] = new Movie($data);
        }

        return $movies;
    }

}
?>