<?php
/**
* TMDB API v3 PHP class - wrapper to API version 3 of 'themoviedb.org
* API Documentation: http://help.themoviedb.org/kb/api/about-3
* Documentation and usage in README file
*
* @pakage TMDB_V3_API_PHP
* @author adangq <adangq@gmail.com>
* @copyright 2012 adangq
* @date 2012-02-12
* @link http://www.github.com/adangq
* @version 0.0.1
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
*
*
* Function List
* 	1.
* 	2.

//configuration		http://api.themoviedb.org/3/configuration
// Imagenes			http://cf2.imgobject.com/t/p/original/IMAGEN.jpg

//Buscar Pelicula		http://api.themoviedb.org/3/search/movie
// Buscar Persona 		http://api.themoviedb.org/3/search/person

//Movie Info			 http://api.themoviedb.org/3/movie/11
//Casts			http://api.themoviedb.org/3/movie/11/casts
//Imagenes			http://api.themoviedb.org/3/movie/11/images
//Trailers			http://api.themoviedb.org/3/movie/11/trailers
//translations		http://api.themoviedb.org/3/movie/11/translations
//Titulos Alternativos 	http://api.themoviedb.org/3/movie/11/alternative_titles

//Collection Info 		http://api.themoviedb.org/3/collection/11
//Person images		http://api.themoviedb.org/3/person/287/images
*/


###########################
$apikey="YOUR APIKEY";
$tmdb_V3 = new TMDBv3($apikey);


class TMDBv3{
	/**#@+
	 * Constants
	 */
	/**
	* url of TMDB api
	*/
	const _API_URL_ = "http://api.themoviedb.org/3/";
	/**
	* Version of Class
	*/
	const VERSION = '0.0.1';
	/**
	* @link http://www.example.com Example link
	* @see myclass()
	* @uses testing, anotherconstant
	* @var array
	*/
	/**
	 * The API-key
	 *
	 * @var string
	 */
	private $_apikey;
	/**
	 * The default language
	 *
	 * @var string
	 */
	private $_lang;
	/**
	* url of TMDB images
	*/
	private $_imgUrl;
###############################################################################################################
    function  __construct($apikey) {
		//Assign Api Key
        $this->setApikey($apikey);
		//Setting Language
        $this->setLang();

		//Get Configuration
		$conf = $this->getConfig();
		if (empty($conf)){echo "Imposible leer configuracion, verifique que la llave de la API sea valida";exit;}
		//set Images URL contain in config
		$this->setImageURL($conf);
    }

	/**
	* Movie Info
	* http://api.themoviedb.org/3/movie/$id
	* @param array  movieInfo
	*/
	public function movieTitles($idMovie)
	{
		$titleTmp = $this->movieInfo($idMovie,"alternative_titles",false);
		foreach ($titleTmp['titles'] as $titleArr){
			$title[]=$titleArr['title']." - ".$titleArr['iso_3166_1'];
		}
		return $title;
	}

	/**
	* Movie Info
	* http://api.themoviedb.org/3/movie/$id
	* @param array  movieInfo
	*/
	public function movieTrans($idMovie)
	{
		$transTmp = $this->movieInfo($idMovie,"translations",false);

		foreach ($transTmp['translations'] as $transArr){
			$trans[]=$transArr['english_name']." - ".$transArr['iso_639_1'];
		}
		return $trans;
	}

	/**
	* Movie Info
	* http://api.themoviedb.org/3/movie/$id
	* @param array  movieInfo
	*/
	public function movieTrailer($idMovie)
	{
		$trailer = $this->movieInfo($idMovie,"trailers",false);
		// $trailer =$trailer['posters'];
		return $trailer;
	}
	public function movieDetail($idMovie)
	{
		return $this->movieInfo($idMovie,"",false);
	}

	/**
	* Movie Info
	* http://api.themoviedb.org/3/movie/$id
	* @param array  movieInfo
	*/
	public function moviePoster($idMovie)
	{
		$posters = $this->movieInfo($idMovie,"images",false);
		$posters =$posters['posters'];
		return $posters;
	}

	/**
	* Movie Info
	* http://api.themoviedb.org/3/movie/$id
	* @param array  movieInfo
	*/
	public function movieCast($idMovie)
	{
		$castingTmp = $this->movieInfo($idMovie,"casts",false);
		foreach ($castingTmp['cast'] as $castArr){
			$casting[]=$castArr['name']." - ".$castArr['character'];
		}
		return $casting;
	}

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
	}

	/**
	* Search Movie
	* http://api.themoviedb.org/3/search/movie?api_keyf&language&query=future
	* @param string  $peopleName
	*/
	public function searchMovie($movieTitle,$lang="en"){
		$movieTitle="query=".urlencode($movieTitle);
		return $this->_call("search/movie",$movieTitle,$lang);
	}

	/**
	* Get Confuguration of API
	* configuration		http://api.themoviedb.org/3/configuration?apikey
	* @param
	* @return array
	*/
	public function getConfig() {
		return $this->_call("configuration","");
	}

	/**
	 * Makes the call to the API
	 *
	 * @param string $action		API specific function name for in the URL
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
		// echo"<pre>";print_r(($results));echo"</pre>";
		$results = json_decode(($results),true);
		return (array) $results;
	}

	/**
	 * Setter for the API-key
	 *
	 * @param string $apikey
	 * @return void
	 */
	private function setApikey($apikey)
	{
		$this->_apikey = (string) $apikey;
	}

	/**
	 * Getter for the API-key
	 *e
	 * @return string
	 */
	private function getApikey() {
		return $this->_apikey;
	}

	/*
	 * Setter for the default language
	 *
	 * @param string $lang
	 * @return void
	 */
	public function setLang($lang="es") {
		$this->_lang = $lang;
	}

	/**
	 * Getter for the default language
	 *
	 * @return string
	 */
	public function getLang() {
		return $this->_lang;
	}

	/**
	* Set URL of images
	* @param  $config Configurarion of API
	* @return array
	*/
	public function setImageURL($config) {
		$this->_imgUrl = (string) $config['images']["base_url"];
	}

	/**
	 * Getter for the URL images
	 *
	 * @return string
	 */
	public function getImageURL() {
		return $this->_imgUrl . "original";
	}

}
?>
