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
* Function List
*   public function  __construct($apikey,$lang='en')
*   public function setLang($lang="en") 
*   public function getLang() 
*   public function setImageURL($config) 
*   public function getImageURL($size="original") 
*   public function movieTitles($idMovie) 
*   public function movieTrans($idMovie)
*   public function movieTrailer($idMovie,$source="") 
*   public function movieDetail($idMovie)
*   public function moviePoster($idMovie)
*   public function movieCast($idMovie)
*   public function movieInfo($idMovie,$option="",$print=false)
*   public function searchMovie($movieTitle)
*   public function getConfig() 
*   public function latestMovie() 
*   public function nowPlayingMovies($page=1) 
*
*   private function _call($action,$text,$lang="")
*   private function setApikey($apikey) 
*   private function getApikey() 

URL LIST:
configuration		http://api.themoviedb.org/3/configuration
Imagenes		http://cf2.imgobject.com/t/p/original/IMAGEN.jpg
Buscar Pelicula		http://api.themoviedb.org/3/search/movie
Buscar Persona		http://api.themoviedb.org/3/search/person
Movie Info		http://api.themoviedb.org/3/movie/11
Casts			http://api.themoviedb.org/3/movie/11/casts
Imagenes		http://api.themoviedb.org/3/movie/11/images
Trailers		http://api.themoviedb.org/3/movie/11/trailers
translations		http://api.themoviedb.org/3/movie/11/translations
Titulos Alternativos 	http://api.themoviedb.org/3/movie/11/alternative_titles

//Collection Info 	http://api.themoviedb.org/3/collection/11
//Person images		http://api.themoviedb.org/3/person/287/images
*
** v0.0.2:
*    fixed issue #2 (Object created in class php file)
*    added functions latestMovie, nowPlayingMovies (thank's to steffmeister)
*

*/


###########################
class TMDBv3{
     #<CONSTANTS>
	#@var string url of API TMDB
	const _API_URL_ = "http://api.themoviedb.org/3/";

	#@var string Version of this class
	const VERSION = '0.0.2';

	#@var string API KEY
	private $_apikey;

	#@var string Default language
	private $_lang;

	#@var string url of TMDB images
	private $_imgUrl;
     #</CONSTANTS>
###############################################################################################################
	/**
	* Construct Class
	* @param string apikey
	* @param string language default is english
	*/
		public function  __construct($apikey,$lang='en') {
			//Assign Api Key
			$this->setApikey($apikey);
		
			//Setting Language
			$this->setLang($lang);

			//Get Configuration
			$conf = $this->getConfig();
			if (empty($conf)){echo "Unable to read configuration, verify that the API key is valid";exit;}

			//set Images URL contain in config
			$this->setImageURL($conf);
		}//end of __construct

	/** Setter for the API-key
	 * @param string $apikey
	 * @return void
	 */
		private function setApikey($apikey) {
			$this->_apikey = (string) $apikey;
		}//end of setApikey

	/** Getter for the API-key
	 *  no input
	 **  @return string
	 */
		private function getApikey() {
			return $this->_apikey;
		}//end of getApikey

	/** Setter for the default language
	 * @param string $lang
	 * @return void
	 **/
		public function setLang($lang="en") {
			$this->_lang = $lang;
		}//end of setLang

	/** Getter for the default language
	 * no input
	 * @return string
	 **/
		public function getLang() {
			return $this->_lang;
		}//end of getLang

	/**
	* Set URL of images
	* @param  $config Configurarion of API
	* @return array
	*/
		public function setImageURL($config) {
			$this->_imgUrl = (string) $config['images']["base_url"];
		} //end of setImageURL

	/** Getter for the URL images
	 * no input
	 * @return string
	 */
		public function getImageURL($size="original") {
			return $this->_imgUrl . $size;
		}//end of getImageURL

	/**
	* movie Alternative Titles
	* http://api.themoviedb.org/3/movie/$id/alternative_titles
	* @param array  titles
	*/
		public function movieTitles($idMovie) {
			$titleTmp = $this->movieInfo($idMovie,"alternative_titles",false);
			foreach ($titleTmp['titles'] as $titleArr){
				$title[]=$titleArr['title']." - ".$titleArr['iso_3166_1'];
			}
			return $title;
		}//end of movieTitles

	/**
	* movie translations
	* http://api.themoviedb.org/3/movie/$id/translations
	* @param array  translationsInfo
	*/
		public function movieTrans($idMovie)
		{
			$transTmp = $this->movieInfo($idMovie,"translations",false);

			foreach ($transTmp['translations'] as $transArr){
				$trans[]=$transArr['english_name']." - ".$transArr['iso_639_1'];
			}
			return $trans;
		}//end of movieTrans

	/**
	* movie Trailer
	* http://api.themoviedb.org/3/movie/$id/trailers
	* @param array  trailerInfo
	*/
		public function movieTrailer($idMovie) {
			$trailer = $this->movieInfo($idMovie,"trailers",false);
			return $trailer;
		} //movieTrailer


	/**
	* movie Detail
	* http://api.themoviedb.org/3/movie/$id
	* @param array  movieDetail
	*/
		public function movieDetail($idMovie)
		{
			return $this->movieInfo($idMovie,"",false);
		}//end of movieDetail

	/**
	* movie Poster
	* http://api.themoviedb.org/3/movie/$id/images
	* @param array  moviePoster
	*/
		public function moviePoster($idMovie)
		{
			$posters = $this->movieInfo($idMovie,"images",false);
			$posters =$posters['posters'];
			return $posters;
		}//end of 

	/**
	* movie Casting
	* http://api.themoviedb.org/3/movie/$id/casts
	* @param array  movieCast
	*/
		public function movieCast($idMovie)
		{
			$castingTmp = $this->movieInfo($idMovie,"casts",false);
			foreach ($castingTmp['cast'] as $castArr){
				$casting[]=$castArr['name']." - ".$castArr['character'];
			}
			return $casting;
		}//end of movieCast

	/**
	* Movie Info
	* http://api.themoviedb.org/3/movie/$id
	* @param array  movieInfo
	*/
		public function movieInfo($idMovie,$option="",$print=false){
			$option = (empty($option))?"":"/" . $option;
			$params = "movie/" . $idMovie . $option;
			$movie= $this->_call($params,"");
				return $movie;
		}//end of movieInfo

	/**
	* Search Movie
	* http://api.themoviedb.org/3/search/movie?api_keyf&language&query=future
	* @param string  $peopleName
	*/
		public function searchMovie($movieTitle){
			$movieTitle="query=".urlencode($movieTitle);
			return $this->_call("search/movie",$movieTitle,$this->_lang);
		}//end of searchMovie


	/**
	* Get Confuguration of API
	* configuration	
	* http://api.themoviedb.org/3/configuration?apikey
	* @return array
	*/
		public function getConfig() {
			return $this->_call("configuration","");
		}//end of getConfig

	/**
	* Latest Movie
	* http://api.themoviedb.org/3/latest/movie?api_key
	* @return array
	*/
		public function latestMovie() {
			return $this->_call('latest/movie','');
		}
	/**
	* Now Playing Movies
	* http://api.themoviedb.org/3/movie/now-playing?api_key&language&page
	* @param integer $page
	*/
	public function nowPlayingMovies($page=1) {
		return $this->_call('movie/now-playing', 'page='.$page);
	}

	/**
	 * Makes the call to the API
	 *
	 * @param string $action	API specific function name for in the URL
	 * @param string $text		Unencoded paramter for in the URL
	 * @return string
	 */
		private function _call($action,$text,$lang=""){
		// # http://api.themoviedb.org/3/movie/11?api_key=XXX
			$lang=(empty($lang))?$this->getLang():$lang;
			$url= TMDBv3::_API_URL_.$action."?api_key=".$this->getApikey()."&language=".$lang."&".$text;
			// echo "<pre>$url</pre>";
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
			// header('Content-Type: text/html; charset=iso-8859-1');
			//echo"<pre>";print_r(($results));echo"</pre>";
			$results = json_decode(($results),true);
			return (array) $results;
		}//end of _call


} //end of class
?>
