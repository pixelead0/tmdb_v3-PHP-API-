## CREDITS  ##
 TMDB API v3 PHP class - wrapper to API version 3 of 'themoviedb.org
 
 API Documentation: http://help.themoviedb.org/kb/api/about-3
 
 Documentation and usage in README file
 
 @pakage TMDB_V3_API_PHP
 
 @author pixelead0 <adangq@gmail.com>
 
 @link http://www.github.com/pixelead0
 
 @date 2012-11-07
 
 @version 0.0.2
 
 ----------------------
 
 Portions of this file are based on pieces of TMDb PHP API class - API 'themoviedb.org'
 
 @Copyright Jonas De Smet - Glamorous | https://github.com/glamorous/TMDb-PHP-API
 
 @date 10.12.2010
 
 @version 0.9.10
 
 @author Jonas De Smet - Glamorous
 
 @link {https://github.com/glamorous/TMDb-PHP-API}
 
 Licensed under BSD (http://www.opensource.org/licenses/bsd-license.php)

# CHANGE LOG #
  * TMDB_V3_API_PHP v0.0.2 (2012-11-07)
    - Fixed issue #2 (Object created in class php file)
    - Added functions latestMovie, nowPlayingMovies (thank's to steffmeister)
 
  * TMDB_V3_API_PHP v0.0.1 (2012-02-12)
    - This is the first version of the class without inline documentation or testing   
 
## Requirements ##
- PHP 5.2.x or higher
- cURL
- TMDB API-key

## How to use ##
View example.php

## Initialize the class ##
    <?php
	    include('tmdb_v3.php');
	    
		//Insert your api key of TMDB    
		$apikey="YOUR_APIKEY";
		$tmdb_V3 = new TMDBv3($apikey);	?>
	?>
## Search a Movie ##
    <?php
		//Title to search for
		$title = 'back to the future';
		$language='es'
		$searchTitle = $tmdb_V3->searchMovie($title,$language);
		// return array
		echo"<pre>";print_r($searchTitle);echo"</pre>";
    ?>
## GET IMAGE URL IN CONFIGUTATION API ##
	<?php
		$imageURL= $tmdb_V3->getImageURL();
		// return array
		echo"<pre>";print_r($imageURL);echo"</pre>";
	?>
## Movie Info  ##
	<?php
		$idMovie=11;
		#Info
		$movieInfo = $tmdb_V3->movieDetail($idMovie);
		// return array
		echo"<pre>";print_r($movieInfo);echo"</pre>";
	?>
## casts ##
	<?php
		$idMovie=11;
		$movieCast = $tmdb_V3->movieCast($idMovie);
	
		// return array
		echo"<pre>";print_r($movieCast);echo"</pre>";
	?>
## images names ##
	<?php
		$idMovie=11;
		$moviePoster = $tmdb_V3->moviePoster($idMovie);
		// return array
		echo"<pre>";print_r($moviePoster);echo"</pre>";
	?>
## trailers ##
	<?php
		$idMovie=11;
		$movieTrailer = $tmdb_V3->movieTrailer($idMovie);
		// return array
		echo"<pre>";print_r($movieTrailer);echo"</pre>";
	?>
## translations ##
	<?php
		$idMovie=11;
		$movieTrans = $tmdb_V3->movieTrans($idMovie);
		// return array
		echo"<pre>";print_r($movieTrans);echo"</pre>";
	?>
## alternative_titles ##
	<?php
		$idMovie=11;
		$movieTitles = $tmdb_V3->movieTitles($idMovie);
		// return array
		echo"<pre>";print_r($movieTitles);echo"</pre>";
	?>
## Issues/Bugs ##
We didn't find any bugs (yet). If you find one, please inform us with the issue tracker on [github](https://github.com/pixelead0/tmdb_v3-PHP-API-/issues).

## TO DO LIST ##
 -Documentation.
## License ##
This plugin has a [BSD License](http://www.opensource.org/licenses/bsd-license.php). You can find the license in license.txt that is included with class-package
