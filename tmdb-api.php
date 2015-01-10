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
 * Mostly code cleaning and documentation
 * @Copyright Alvaro Octal | https://github.com/Alvaroctal/TMDB-PHP-API
 * Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)
 * @date 09/01/2015
 * @version 0.0.2.1
 * @author Alvaro Octal
 * @link {https://github.com/Alvaroctal/TMDB-PHP-API}
 *
 * 	Function List
 *   	public function  __construct($apikey,$lang='en')
 *   	public function setLang($lang="en") 
 *   	public function getLang() 
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
 *   	public function getConfig() 
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
 * 		// Collection Info 	http://api.themoviedb.org/3/collection/11
 * 		// Person images		http://api.themoviedb.org/3/person/287/images
 */

include("data/Movie.php");

class TMDB{

	#@var string url of API TMDB
	const _API_URL_ = "http://api.themoviedb.org/3/";

	#@var string Version of this class
	const VERSION = '0.0.2.1';

	#@var string API KEY
	private $_apikey;

	#@var string Default language
	private $_lang;

	#@var string url of TMDB images
	private $_imgUrl;
        
    public $config;

	/**
	 * 	Construct Class
	 *
	 * 	@param string $apikey The API key token
	 * 	@param string $lang The languaje to work with, default is english
	 */
	public function  __construct($apikey, $lang = 'en') {

		// Sets the API key
		$this->setApikey($apikey);
	
		//Setting Language
		$this->setLang($lang);

		//Get Configuration
		$this->config = $this->_getConfig();
		if (empty($this->config)){
			echo "Unable to read configuration, verify that the API key is valid (". $this->_apikey .")";
			exit;
		}

		//set Images URL contain in config
		$this->setImageURL($this->config);
	}
         
	/** 
	 * 	Setter for the API-key
	 *
	 * 	@param string $apikey
	 * 	@return void
	 */
	private function setApikey($apikey) {
		$this->_apikey = (string) $apikey;
	}

	/** 
	 * 	Getter for the API-key
	 *
	 * 	@return string
	 */
	private function getApikey() {
		return $this->_apikey;
	}

	/** 
	 *  Setter for the default language
	 * 	@param string $lang
	 * 	@return void
	 **/
	public function setLang($lang = 'en') {
		$this->_lang = $lang;
	}

	/** 
	 * 	Getter for the default language
	 * 	@return string
	 **/
	public function getLang() {
		return $this->_lang;
	}

	/**
	 * 	Set URL of images
	 * 	@param  $config Configurarion of API
	 * 	@return array
	 */
	public function setImageURL($config) {
		$this->_imgUrl = (string) $this->config['images']['base_url'];
	}

	/** 
	 *	Getter for the URL images
	 * 	@return string
	 */
	public function getImageURL($size = 'original') {
		return $this->_imgUrl . $size;
	}

	/**
	 * 	Movie Alternative Titles
	 * 	http://api.themoviedb.org/3/movie/$id/alternative_titles
	 * 	@param array  titles
	 */
	public function movieTitles($idMovie) {
		$titleTmp = $this->movieInfo($idMovie, 'alternative_titles', false);
		foreach ($titleTmp['titles'] as $titleArr){
			$title[] = $titleArr['title'].' - '.$titleArr['iso_3166_1'];
		}

		return $title;
	}

	/**
	 * Movie Translations
	 *
	 * @param array  translationsInfo
	 * @return array
	 */
	public function movieTrans($idMovie){
		$transTmp = $this->movieInfo($idMovie, 'translations', false);

		foreach ($transTmp['translations'] as $transArr){
			$trans[] = $transArr['english_name'].' - '.$transArr['iso_639_1'];
		}

		return $trans;
	}

	/**
	 * Movie Trailer
	 *
	 * @param int $idMovie The Movie id
	 * @see #movieInfo()
	 * @return array
	 */
	public function movieTrailer($idMovie) {
		return $this->movieInfo($idMovie, 'trailers', false);
	}

	/**
	 * 	Movie Detail
	 *
	 * 	@param int $idMovie The Movie id
	 * 	@return array
	 */
	public function movieDetail($idMovie){
		return $this->movieInfo($idMovie, '', false);
	}

	/**
	 * 	Get the images of a Movie
	 *
	 * 	@param int $idMovie The Movie id
	 * 	@return Image[]
	 */
	public function getImages($idMovie){
		$result = $this->movieInfo($idMovie, 'images', false);

		return $result['posters'];
	}

	/**
	 * Movie Casting
	 *
	 * @param array  movieCast
	 * @see #movieInfo()
	 * @return array
	 */
	public function movieCast($idMovie){
		$castingTmp = $this->movieInfo($idMovie,'casts',false);
		foreach ($castingTmp['cast'] as $castArr){
			$casting[]=$castArr['name'].' - '.$castArr['character'];
		}

		return $casting;
	}

	/**
	 * 	Movie Info
     * 	@param string $append_requst additional request
	 * 	@param array  movieInfo
	 * 	@see #movieInfo()
     */ 
	public function movieInfo($idMovie, $option = '', $append_request = ''){
		$option = (empty($option)) ? '' : '/' . $option;
		$params = 'movie/' . $idMovie . $option;
		$movie = $this->_getDataArray($params, $append_request);
			
		return $movie;
	}

	/**
	 *  Search Movie
	 *
	 * @param string $movieTitle The title of a Movie
	 * @return array
	 * @see #movieInfo()
	 */
	public function searchMovie($movieTitle){
		$movieTitle = 'query='. urlencode($movieTitle);

		return $this->_getDataArray('search/movie', $movieTitle, $this->getLang());
	}

	/**
	 * 	Get Configuration of API
	 * 	@return array $config
	 */
	private function _getConfig() {
		return $this->_getDataArray('configuration', '');
	}

    /**
     * 	Get Configuration of the API (Revisar)
     * 	
     */           
    public function getConfig(){
        return $this->config;
    }

	/**
	 * 	Latest Movie
	 * 	@return array
	 */
	public function latestMovie() {
		return $this->_getDataArray('movie/latest','');
	}

	/**
	 *    Now Playing Movies
	 *
	 * @param integer $page
	 *
	 * @link http://api.themoviedb.org/3/movie/now-playing?api_key&language&{{$page}}
	 * @return array
	 */
	public function nowPlayingMovies($page = 1) {
		return $this->_getDataArray('movie/now-playing', 'page='.$page);
	}

	/**
	 * 	Transforms the API Response in a Array
	 *
	 * 	@param string $action	API specific function name for in the URL
	 * 	@param string $text		Unencoded paramter for in the URL
	 * 	@return array
	 *
	 * 	@link http://api.themoviedb.org/3/movie/11?api_key={{$apiKey}}
	 */
	private function _getDataArray($action, $text){

		$json = $this->_getDataJSON($action, $text);
		$results = json_decode(($json), true);
		//header('Content-Type: text/html; charset=iso-8859-1');
		//var_dump(debug_backtrace());
		//echo"JSONData: <pre>";print_r(($json));echo"</pre>";
		//echo"ArrayData: <pre>";print_r(($results));echo"</pre>";
		return (array) $results;
	}    

	/**
	 * 	Makes the call to the API and retrieves the data as a JSON
	 *
	 * 	@param string $action	API specific function name for in the URL
	 * 	@param string $text		Unencoded parameter for in the URL
	 * 	@return string
	 *
	 * 	@link http://api.themoviedb.org/3/movie/11?api_key={{$apiKey}}
	 */
	private function _getDataJSON($action, $text){

		$url = self::_API_URL_.$action .'?api_key='. $this->getApikey() .'&language='. $this->getLang() .'&'.$text; 			
		//echo "<pre>$url</pre>";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FAILONERROR, 1);

		$results = curl_exec($ch);
		$headers = curl_getinfo($ch);

		$error_number = curl_errno($ch);
		$error_message = curl_error($ch);

		curl_close($ch);

		return $results;
	}  

	/**
	 * 	Get a Movie
	 * 	@param int $idMovie The Movie id
	 * 	@return Movie
	 */
	public function getMovie($idMovie){
		return new Movie($this->_getDataJSON('movie/' . $idMovie, 'append_to_response=trailers,images'));
	}
}
?>
