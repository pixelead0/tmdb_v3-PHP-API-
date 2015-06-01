<?php
/**
 * 	This class handles all the data you can get from a Company
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Company extends TMDBObject {

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
}
?>