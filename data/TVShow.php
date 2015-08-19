<?php
/**
 * 	This class handles all the data you can get from a TVShow
 *
 * 	@author Alvaro Octal | <a href="https://twitter.com/Alvaro_Octal">Twitter</a>
 * 	@version 0.1
 * 	@date 11/01/2015
 * 	@link https://github.com/Alvaroctal/TMDB-PHP-API
 * 	@copyright Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 */

class TVShow extends TMDBObject {

    /**
     * 	Get the TVShow's original name
     *
     * 	@return string
     */
    public function getOriginalName() {
        return $this->_data['original_name'];
    }

    /**
     * 	Get the TVShow's number of seasons
     *
     * 	@return int
     */
    public function getNumSeasons() {
        return $this->_data['number_of_seasons'];
    }

    /**
     *  Get the TVShow's number of episodes
     *
     * 	@return int
     */
    public function getNumEpisodes() {
        return $this->_data['number_of_episodes'];
    }

    /**
     *  Get a TVShow's season
     *
     *  @param int $numSeason The season number
     * 	@return int
     */
    public function getSeason($numSeason) {
        foreach($this->_data['seasons'] as $season){
            if ($season['season_number'] == $numSeason){
                $data = $season;
                break;
            }
        }
        return new Season($data);
    }

    /**
     *  Get the TvShow's seasons
     *
     * 	@return Season[]
     */
    public function getSeasons() {
        $seasons = array();

        foreach($this->_data['seasons'] as $data){
            $seasons[] = new Season($data, $this->getID());
        }

        return $seasons;
    }

    /**
     * 	Get the TVShow's Poster
     *
     * 	@return string
     */
    public function getPoster() {
        return $this->_data['poster_path'];
    }

    /**
     * 	Get the TVShow's Backdrop
     *
     * 	@return string
     */
    public function getBackdrop() {
        return $this->_data['backdrop_path'];
    }

    /**
     * 	Get the TVShow's Overview
     *
     * 	@return string
     */
    public function getOverview() {
        return $this->_data['overview'];
    }

    /**
     * 	Get the TVShow's vote average
     *
     * 	@return int
     */
    public function getVoteAverage() {
        return $this->_data['vote_average'];
    }

    /**
     * 	Get the TVShow's vote count
     *
     * 	@return int
     */
    public function getVoteCount() {
        return $this->_data['vote_count'];
    }

    /**
     * 	Get if the TVShow is in production
     *
     * 	@return boolean
     */
    public function getInProduction() {
        return $this->_data['in_production'];
    }

	/**
     * 	Get the TVShow Credits
     *
     * 	@return array
     */
    public function getCredits() {
        return $this->_data['credits'];
    }
	
	/**
     * 	Get the TVShow Cast
     *
     * 	@return person[]
     */
    public function getCast() {
         $cast = array();

        foreach( $this->_data['credits']['cast'] as $data ){
            $cast[] = new Person( $data );
        }

        return $cast;
    }
	
	/**
     * 	Get the TVShow Crew
     *
     * 	@return person[]
     */
    public function getCrew() {
         $crew = array();

        foreach( $this->_data['credits']['crew'] as $data ){
            $crew[] = new Person( $data );
        }

        return $crew;
    }
	
	/**
     * 	Get the TVShow Genres
     *
     * 	@return genre[]
     */
    public function getGenres() {
         $genres = array();

        foreach( $this->_data['genres'] as $data ){
            $genres[] = new Genre( $data );
        }

        return $genres;
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
         return $tmdb->getTVShow($this->getID());
    }

}
?>