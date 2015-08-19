<?php
/**
 * 	This class handles all the data you can get from a Season
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class Season extends TMDBObject {

    //------------------------------------------------------------------------------
    // Class Variables
    //------------------------------------------------------------------------------

    private $_idTVShow;

    /**
     * 	Construct Class
     *
     * 	@param array $data An array with the data of the Season
     */
    public function __construct($data, $idTVShow) {
        parent::__construct( $data );
        $this->_data['tvshow_id'] = $idTVShow;
    }

    //------------------------------------------------------------------------------
    // Get Variables
    //------------------------------------------------------------------------------

    /**
     *  Get the Season's TVShow id
     *
     *  @return int
     */
    public function getTVShowID() {
        return $this->_data['tvshow_id'];
    }

    /**
     * 	Get the Season's number
     *
     * 	@return int
     */
    public function getSeasonNumber() {
        return $this->_data['season_number'];
    }

    /**
     * 	Get the Season's number of episodes
     *
     * 	@return int
     */
    public function getNumEpisodes() {
        return count($this->_data['episodes']);
    }

    /**
     *  Get a Seasons's Episode
     *
     *  @param int $numEpisode The episode number
     * 	@return int
     */
    public function getEpisode($numEpisode) {
        return new Episode($this->_data['episodes'][$numEpisode]);
    }

    /**
     *  Get the Season's Episodes
     *
     * 	@return Episode[]
     */
    public function getEpisodes() {
        $episodes = array();

        foreach($this->_data['episodes'] as $data){
            $episodes[] = new Episode($data, $this->getTVShowID());
        }

        return $episodes;
    }

	/**
     * 	Get the Season's Overview
     *
     * 	@return string
     */
    public function getOverview() {
        return $this->_data['overview'];
    }
	
    /**
     * 	Get the Seasons's Poster
     *
     * 	@return string
     */
    public function getPoster() {
        return $this->_data['poster_path'];
    }

    /**
     * 	Get the Season's AirDate
     *
     * 	@return string
     */
    public function getAirDate() {
        return $this->_data['air_date'];
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
       return $tmdb->getSeason($this->getTVShowID(), $this->getSeasonNumber());
    }

}
?>