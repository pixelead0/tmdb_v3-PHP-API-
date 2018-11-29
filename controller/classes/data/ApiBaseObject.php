<?php

/**
 * 	This class is the base class for all data all the data you can get from a Movie
 *
 *	@package TMDB-V3-PHP-API
 * 	@author Bogdan Finn | <a href="https://twitter.com/BogdanFinn">Twitter</a>
 * 	@version 0.1
 * 	@date 14/09/2017
 * 	@link https://github.com/pixelead0/tmdb_v3-PHP-API-
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */
class ApiBaseObject
{
    //------------------------------------------------------------------------------
    // Class Constants
    //------------------------------------------------------------------------------

    const MEDIA_TYPE_MOVIE = 'movie';
    const CREDITS_TYPE_CAST = 'cast';
    const CREDITS_TYPE_CREW = 'crew';
    const MEDIA_TYPE_TV = 'tv';

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    protected $_data;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the ApiObject
     */
    public function __construct($data) {
        $this->_data = $data;
    }

    /**
     * 	Get the ApiObject id
     *
     * 	@return int
     */
    public function getID() {
        return $this->_data['id'];
    }

    /**
     * 	Get the ApiObject Poster
     *
     * 	@return string
     */
    public function getPoster() {
        return $this->_data['poster_path'];
    }

    /**
     * 	Get the ApiObjects vote average
     *
     * 	@return int
     */
    public function getVoteAverage() {
        return $this->_data['vote_average'];
    }

    /**
     * 	Get the ApiObjects vote count
     *
     * 	@return int
     */
    public function getVoteCount() {
        return $this->_data['vote_count'];
    }

    /**
     * Get the ApiObjects Cast
     * @return array of Person
     */
    public function getCast(){
        return $this->getCredits(self::CREDITS_TYPE_CAST);
    }

    /**
     * Get the Cast or the Crew of an ApiObject
     * @param string $key
     * @return array of Person
     */
    protected function getCredits($key){
        $persons = [];

        foreach ($this->_data['credits'][$key] as $data) {
            $persons[] = new Person($data);
        }

        return $persons;
    }

    /**
     * Get the ApiObject crew
     * @return array of Person
     */
    public function getCrew(){
        return $this->getCredits(self::CREDITS_TYPE_CREW);
    }

    /**
     *  Get Generic.<br>
     *  Get a item of the array, you should not get used to use this, better use specific get's.
     *
     * 	@param string $item The item of the $data array you want
     * 	@return array
     */
    public function get($item = ''){

        if(empty($item)){
            return $this->_data;
        }

        if(array_key_exists($item, $this->_data)){
            return $this->_data[$item];
        }

        return null;
    }
}