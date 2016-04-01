<?php
/**
 * TMDB API v3 PHP class - wrapper to API version 3 of 'themoviedb.org
 * API Documentation: http://help.themoviedb.org/kb/api/about-3
 * Documentation and usage in README file
 *
 * @pakage TMDB_V3_API_PHP
 * @author adangq <adangq@gmail.com>
 * @copyright 2012 pixelead0
 * @date 2012-02-12
 * @link http://www.github.com/pixelead
 * @version 0.0.2
 * @license BSD http://www.opensource.org/licenses/bsd-license.php
 *
 *
 * Portions of this file are based on pieces of TMDb PHP API class - API 'themoviedb.org'
 * @Copyright Jonas De Smet - Glamorous | https://github.com/glamorous/TMDb-PHP-API
 * Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 * @date 10.12.2010
 * @version 0.9.10
 * @author Jonas De Smet - Glamorous
 * @link {https://github.com/glamorous/TMDb-PHP-API}
 *
 * Added config file + some formal corrections inside comments + some code changes to use config + (hopefully) corrected versioning
 * @Copyright Deso85 | https://github.com/deso85/tmdb_v3-PHP-API-
 * Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 * @date 01.04.2016
 * @version 0.4
 * @author Deso85
 * @link {https://github.com/deso85/tmdb_v3-PHP-API-}
 *
 * 	Function List
 *   	public function  __construct($apikey,$lang,$adult,$debug)
 *   	public function setLang($lang="en")
 *   	public function getLang()
 *   	public function setAdult($adult=false);
 *   	public function getAdult();
 *   	public function setDebug($debug=false);
 *   	public function getDebug();
 *   	public function setImageURL($config)
 *   	public function getImageURL($size="original")
 *   	public function movieTitles($idMovie)
 *   	public function movieTrans($idMovie)
 *   	public function movieTrailer($idMovie,$source="")
 *   	public function movieDetail($idMovie)
 *   	public function moviePoster($idMovie)
 *   	public function movieCast($idMovie)
 *   	public function movieInfo($idMovie,$option="",$print=false)
 *   	public function searchMovie($movieTitle)
 *   	public function getAPIConfig()
 *   	public function latestMovie()
 *   	public function nowPlayingMovies($page=1)
 *
 *   	private function _getDataArray($action,$text,$lang="")
 *   	private function setApikey($apikey)
 *   	private function getApikey()
 *
 *
 * 	URL LIST:
 *   	configuration		http://api.themoviedb.org/3/configuration
 * 		Image				http://cf2.imgobject.com/t/p/original/IMAGEN.jpg #### echar un ojo ####
 * 		Search Movie		http://api.themoviedb.org/3/search/movie
 * 		Search Person		http://api.themoviedb.org/3/search/person
 * 		Movie Info			http://api.themoviedb.org/3/movie/11
 * 		Casts				http://api.themoviedb.org/3/movie/11/casts
 * 		Posters				http://api.themoviedb.org/3/movie/11/images
 * 		Trailers			http://api.themoviedb.org/3/movie/11/trailers
 * 		translations		http://api.themoviedb.org/3/movie/11/translations
 * 		Alternative titles 	http://api.themoviedb.org/3/movie/11/alternative_titles
 *
 * 		Collection Info 	http://api.themoviedb.org/3/collection/11
 * 		Person images		http://api.themoviedb.org/3/person/287/images
 */

include("data/Movie.php");
include("data/TVShow.php");
include("data/Season.php");
include("data/Episode.php");
include("data/Person.php");
include("data/Role.php");
include("data/roles/MovieRole.php");
include("data/roles/TVShowRole.php");
include("data/Collection.php");
include("data/Company.php");
include("data/Genre.php");
include("data/config/APIConfiguration.php");

class TMDB {
	
	#@var string url of API TMDB
	const _API_URL_ = "http://api.themoviedb.org/3/";

	#@var string Version of this class
	const VERSION = '0.0.3.0';

	#@var array of config parameters
	private $_config;
	
	#@var string API KEY
	private $_apikey;

	#@var string Default language
	private $_lang;
	
	#@var string for adult content
	private $_adult;
	
	#@var array of TMDB config
    private $_apiconfiguration;
    
	#@var boolean for testing
	private $_debug;

	
	
	/**
	 * 	Construct Class
	 *
	 * 	@param string $apikey The API key token
	 * 	@param string $lang The language to work with, default is english
	 *  @param boolean $adult The flag for adult content
	 *  @param boolean $debug The flag for debug output
	 */
	public function __construct($apikey = null, $lang = null, $adult = null, $debug = null) {
		require_once("data/config/config.php");
		
		// Set config params
		$this->setConfig($cnf);
		
		// Sets the API key
		$this->setApikey((isset($apikey)) ? $apikey : $cnf['apikey']);

		// Setting Language
		$this->setLang((isset($lang)) ? $lang : $cnf['lang']);
		
		// Set if adult content shall be displayed
		$this->setAdult((isset($adult)) ? $adult : $cnf['adult']);
		
		// Set the debug mode
		$this->setDebug((isset($debug)) ? $debug : $cnf['debug']);

		// Load the API configuration
		if (! $this->_loadConfig()){
			echo _("Unable to read configuration, verify that the API key is valid");
			exit;
		}
	}

	//------------------------------------------------------------------------------
	// Configuration Parameters
	//------------------------------------------------------------------------------
	
	/**
	 *  Set configuration parameters
	 *
	 * 	@param array $config
	 */
	private function setConfig($config) {
		$this->_config = $config;
	}
	
	/**
	 * 	Get the config parameters
	 *
	 * 	@return array $config
	 */
	private function getConfig() {
		return $this->_config;
	}
	
	//------------------------------------------------------------------------------
	// Api Key
	//------------------------------------------------------------------------------

	/**
	 * 	Set the API key
	 *
	 * 	@param string $apikey
	 * 	@return void
	 */
	private function setApikey($apikey) {
		$this->_apikey = (string) $apikey;
	}

	/**
	 * 	Get the API key
	 *
	 * 	@return string
	 */
	private function getApikey() {
		return $this->_apikey;
	}

	//------------------------------------------------------------------------------
	// Language
	//------------------------------------------------------------------------------

	/**
	 *  Set the language
	 *	By default english
	 *
	 * 	@param string $lang
	 */
	public function setLang($lang = 'en') {
		$this->_lang = (string) $lang;
	}

	/**
	 * 	Get the language
	 *
	 * 	@return string
	 */
	public function getLang() {
		return $this->_lang;
	}

	//------------------------------------------------------------------------------
	// Adult Content
	//------------------------------------------------------------------------------

	/**
	 *  Set adult content flag
	 *	By default false
	 *
	 * 	@param boolean $adult
	 */
	public function setAdult($adult = false) {
		$this->_adult = $adult;
	}

	/**
	 * 	Get the adult content flag
	 *
	 * 	@return string
	 */
	public function getAdult() {
		return ($this->_adult) ? 'true' : 'false';
	}
	
	//------------------------------------------------------------------------------
	// Debug Mode
	//------------------------------------------------------------------------------
	
	/**
	 *  Set debug mode
	 *	By default false
	 *
	 * 	@param boolean $debug
	 */
	public function setDebug($debug = false) {
		$this->_debug = $debug;
	}
	
	/**
	 * 	Get debug status
	 *
	 * 	@return boolean
	 */
	public function getDebug() {
		return $this->_debug;
	}

	//------------------------------------------------------------------------------
	// Config
	//------------------------------------------------------------------------------

	/**
	 * 	Loads the configuration of the API
	 *
	 * 	@return boolean
	 */
	private function _loadConfig() {
		$this->_apiconfiguration = new APIConfiguration($this->_call('configuration'));

		return ! empty($this->_apiconfiguration);
	}

	/**
	 * 	Get Configuration of the API (Revisar)
	 *
	 * 	@return Configuration
	 */
	public function getAPIConfig() {
		return $this->_apiconfiguration;
	}

	//------------------------------------------------------------------------------
	// Get Variables
	//------------------------------------------------------------------------------

	/**
	 *	Get the URL images
	 * 	You can specify the width, by default original
	 *
	 * 	@param String $size A String like 'w185' where you specify the image width
	 * 	@return string
	 */
	public function getImageURL($size = 'original') {
		return $this->_apiconfiguration->getImageBaseURL().$size;
	}

	//------------------------------------------------------------------------------
	// Get Lists of Discover
	//------------------------------------------------------------------------------

	/**
	 * 	Discover Movies
	 *	@add by tnsws
	 *
	 * 	@return Movie[]
	 */
	public function getDiscoverMovies($page = 1) {

		$movies = array();

		$result = $this->_call('discover/movie', '&page='. $page);

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}

	/**
	 * 	Discover TVShows
	 *	@add by tnsws
	 *
	 * 	@return TVShow[]
	 */
	public function getDiscoverTVShows($page = 1) {

		$tvShows = array();

		$result = $this->_call('discover/tv', '&page='. $page);

		foreach($result['results'] as $data){
			$tvShows[] = new TVShow($data);
		}

		return $tvShows;
	}

	//------------------------------------------------------------------------------
	// Get Lists of Discover
	//------------------------------------------------------------------------------

	/**
	 * 	Get latest Movie
	 *	@add by tnsws
	 *
	 * 	@return Movie
	 */
	public function getDiscoverMovie($page = 1) {

		$movies = array();

		$result = $this->_call('discover/movie', 'page='. $page);

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}

	//------------------------------------------------------------------------------
	// Get Featured Movies
	//------------------------------------------------------------------------------

	/**
	 * 	Get latest Movie
	 *
	 * 	@return Movie
	 */
	public function getLatestMovie() {
		return new Movie($this->_call('movie/latest'));
	}

	/**
	 *  Get Now Playing Movies
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getNowPlayingMovies($page = 1) {

		$movies = array();

		$result = $this->_call('movie/now_playing', '&page='. $page);

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}

	/**
	 *  Get Popular Movies
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getPopularMovies($page = 1) {

		$movies = array();

		$result = $this->_call('movie/popular', '&page='. $page);

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}

	/**
	 *  Get Top Rated Movies
	 *	@add by tnsws
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getTopRatedMovies($page = 1) {

		$movies = array();

		$result = $this->_call('movie/top_rated', '&page='. $page);

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}

	/**
	 *  Get Upcoming Movies
	 *	@add by tnsws
	 *
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getUpcomingMovies($page = 1) {

		$movies = array();

		$result = $this->_call('movie/upcoming', '&page='. $page);

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}


	//------------------------------------------------------------------------------
	// Get Featured TVShows
	//------------------------------------------------------------------------------

	/**
	 * 	Get latest TVShow
	 *
	 * 	@return TVShow
	 */
	public function getLatestTVShow() {
		return new TVShow($this->_call('tv/latest'));
	}

	/**
	 *  Get On The Air TVShows
	 *
	 * 	@param integer $page
	 * 	@return TVShow[]
	 */
	public function getOnTheAirTVShows($page = 1) {

		$tvShows = array();

		$result = $this->_call('tv/on_the_air', '&page='. $page);

		foreach($result['results'] as $data){
			$tvShows[] = new TVShow($data);
		}

		return $tvShows;
	}

	/**
	 *  Get Airing Today TVShows
	 *
	 * 	@param integer $page
	 * 	@param string $timezone
	 * 	@return TVShow[]
	 */
	public function getAiringTodayTVShows($page = 1, $timeZone = 'Europe/Madrid') {

		$tvShows = array();

		$result = $this->_call('tv/airing_today', '&page='. $page);

		foreach($result['results'] as $data){
			$tvShows[] = new TVShow($data);
		}

		return $tvShows;
	}

	/**
	 *  Get Top Rated TVShows
	 *
	 * 	@param integer $page
	 * 	@return TVShow[]
	 */
	public function getTopRatedTVShows($page = 1) {

		$tvShows = array();

		$result = $this->_call('tv/top_rated', '&page='. $page);

		foreach($result['results'] as $data){
			$tvShows[] = new TVShow($data);
		}

		return $tvShows;
	}

	/**
	 *  Get Popular TVShows
	 *
	 * 	@param integer $page
	 * 	@return TVShow[]
	 */
	public function getPopularTVShows($page = 1) {

		$tvShows = array();

		$result = $this->_call('tv/popular', '&page='. $page);

		foreach($result['results'] as $data){
			$tvShows[] = new TVShow($data);
		}

		return $tvShows;
	}

	//------------------------------------------------------------------------------
	// Get Featured Persons
	//------------------------------------------------------------------------------

	/**
	 * 	Get latest Person
	 *
	 * 	@return Person
	 */
	public function getLatestPerson() {
		return new Person($this->_call('person/latest'));
	}

	/**
	 * 	Get Popular Persons
	 *
	 * 	@return Person[]
	 */
	public function getPopularPersons($page = 1) {
		$persons = array();

		$result = $this->_call('person/popular', '&page='. $page);

		foreach($result['results'] as $data){
			$persons[] = new Person($data);
		}

		return $persons;
	}

	//------------------------------------------------------------------------------
	// API Call
	//------------------------------------------------------------------------------

	/**
	 * 	Makes the call to the API and retrieves the data as a JSON
	 *
	 * 	@param string $action	API specific function name for in the URL
	 * 	@param string $appendToResponse	The extra append of the request
	 * 	@return string
	 */
	private function _call($action, $appendToResponse = '') {

		$url = self::_API_URL_.$action .'?api_key='. $this->getApikey() .'&language='.$this->getLang().'&append_to_response='.implode(',', (array) $appendToResponse).'&include_adult='.$this->getAdult();

		if ($this->_debug) {
			echo '<pre><a href="' . $url . '">check request</a></pre>';
		}

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);

		$results = curl_exec($ch);

		curl_close($ch);

		return (array) json_decode(($results), true);
	}

	//------------------------------------------------------------------------------
	// Get Data Objects
	//------------------------------------------------------------------------------

	/**
	 * 	Get a Movie
	 *
	 * 	@param int $idMovie The Movie id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Movie
	 */
	public function getMovie($idMovie, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()['appender']['movie'];
		
		return new Movie($this->_call('movie/' . $idMovie, $appendToResponse));
	}

	/**
	 * 	Get a TVShow
	 *
	 * 	@param int $idTVShow The TVShow id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return TVShow
	 */
	public function getTVShow($idTVShow, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()['appender']['tvshow'];
		
		return new TVShow($this->_call('tv/' . $idTVShow, $appendToResponse));
	}

	/**
	 * 	Get a Season
	 *
	 *  @param int $idTVShow The TVShow id
	 *  @param int $numSeason The Season number
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Season
	 */
	public function getSeason($idTVShow, $numSeason, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()['appender']['season'];
		
		return new Season($this->_call('tv/'. $idTVShow .'/season/' . $numSeason, $appendToResponse), $idTVShow);
	}

	/**
	 * 	Get a Episode
	 *
	 *  @param int $idTVShow The TVShow id
	 *  @param int $numSeason The Season number
	 *  @param int $numEpisode the Episode number
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Episode
	 */
	public function getEpisode($idTVShow, $numSeason, $numEpisode, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()['appender']['episode'];
		
		return new Episode($this->_call('tv/'. $idTVShow .'/season/'. $numSeason .'/episode/'. $numEpisode, $appendToResponse), $idTVShow);
	}

	/**
	 * 	Get a Person
	 *
	 * 	@param int $idPerson The Person id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Person
	 */
	public function getPerson($idPerson, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()['appender']['person'];
		
		return new Person($this->_call('person/' . $idPerson, $appendToResponse));
	}

	/**
	 * 	Get a Collection
	 *
	 * 	@param int $idCollection The Person id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Collection
	 */
	public function getCollection($idCollection, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()['appender']['collection'];
		
		return new Collection($this->_call('collection/' . $idCollection, $appendToResponse));
	}

	/**
	 * 	Get a Company
	 *
	 * 	@param int $idCompany The Person id
	 * 	@param array $appendToResponse The extra append of the request
	 * 	@return Company
	 */
	public function getCompany($idCompany, $appendToResponse = null) {
		$appendToResponse = (isset($appendToResponse)) ? $appendToResponse : $this->getConfig()['appender']['company'];
		
		return new Company($this->_call('company/' . $idCompany, $appendToResponse));
	}

	//------------------------------------------------------------------------------
	// Searches
	//------------------------------------------------------------------------------

	/**
	 *  Search Movie
	 *
	 * 	@param string $movieTitle The title of a Movie
	 * 	@return Movie[]
	 */
	public function searchMovie($movieTitle){

		$movies = array();

		$result = $this->_call('search/movie', '&query='. urlencode($movieTitle));

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}

	/**
	 *  Search TVShow
	 *
	 * 	@param string $tvShowTitle The title of a TVShow
	 * 	@return TVShow[]
	 */
	public function searchTVShow($tvShowTitle){

		$tvShows = array();

		$result = $this->_call('search/tv', '&query='. urlencode($tvShowTitle));

		foreach($result['results'] as $data){
			$tvShows[] = new TVShow($data);
		}

		return $tvShows;
	}

	/**
	 *  Search Person
	 *
	 * 	@param string $personName The name of the Person
	 * 	@return Person[]
	 */
	public function searchPerson($personName){

		$persons = array();

		$result = $this->_call('search/person', '&query='. urlencode($personName));

		foreach($result['results'] as $data){
			$persons[] = new Person($data);
		}

		return $persons;
	}

	/**
	 *  Search Collection
	 *
	 * 	@param string $collectionName The name of the Collection
	 * 	@return Collection[]
	 */
	public function searchCollection($collectionName){

		$collections = array();

		$result = $this->_call('search/collection', '&query='. urlencode($collectionName));

		foreach($result['results'] as $data){
			$collections[] = new Collection($data);
		}

		return $collections;
	}

	/**
	 *  Search Company
	 *
	 * 	@param string $companyName The name of the Company
	 * 	@return Company[]
	 */
	public function searchCompany($companyName){

		$companies = array();

		$result = $this->_call('search/company', '&query='. urlencode($companyName));

		foreach($result['results'] as $data){
			$companies[] = new Company($data);
		}

		return $companies;
	}

	//------------------------------------------------------------------------------
	// Find
	//------------------------------------------------------------------------------

	/**
	 *  Find
	 *
	 * 	@param string $companyName The name of the Company
	 * 	@return array
	 */
	public function find($id, $external_source = 'imdb_id'){

		$found = array();

		$result = $this->_call('find/'.$id, '&external_source='. urlencode($external_source));

		foreach($result['movie_results'] as $data){
			$found['movies'][] = new Movie($data);
		}
		foreach($result['person_results'] as $data){
			$found['persons'][] = new Person($data);
		}
		foreach($result['tv_results'] as $data){
			$found['tvshows'][] = new TVShow($data);
		}
		foreach($result['tv_season_results'] as $data){
			$found['seasons'][] = new Season($data);
		}
		foreach($result['tv_episode_results'] as $data){
			$found['episodes'][] = new Episode($data);
		}

		return $found;
	}

	//------------------------------------------------------------------------------
	// API Extra Info
	//------------------------------------------------------------------------------

	/**
	 * 	Get Timezones
	 *
	 * 	@return array
	 */
	public function getTimezones() {
		return $this->_call('timezones/list');
	}

	/**
	 * 	Get Jobs
	 *
	 * 	@return array
	 */
	public function getJobs() {
		return $this->_call('job/list');
	}

	/**
	 * 	Get Movie Genres
	 *
	 * 	@return Genre[]
	 */
	public function getMovieGenres() {

		$genres = array();

		$result = $this->_call('genre/movie/list');

		foreach($result['genres'] as $data){
			$genres[] = new Genre($data);
		}

		return $genres;
	}

	/**
	 * 	Get TV Genres
	 *
	 * 	@return Genre[]
	 */
	public function getTVGenres() {

		$genres = array();

		$result = $this->_call('genre/tv/list');

		foreach($result['genres'] as $data){
			$genres[] = new Genre($data);
		}

		return $genres;
	}

	//------------------------------------------------------------------------------
	// Genre
	//------------------------------------------------------------------------------

	/**
	 *  Get Movies by Genre
	 *
	 *  @param integer $idGenre
	 * 	@param integer $page
	 * 	@return Movie[]
	 */
	public function getMoviesByGenre($idGenre, $page = 1) {

		$movies = array();

		$result = $this->_call('genre/'.$idGenre.'/movies', '&page='. $page);

		foreach($result['results'] as $data){
			$movies[] = new Movie($data);
		}

		return $movies;
	}
}
?>
