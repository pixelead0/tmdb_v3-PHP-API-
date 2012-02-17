## CREDITS  ##

Some lines of this class is _NOT_ my code.  

I simply updated it for the API version 3 from the TMDb PHP API class - API 'themoviedb.

The author of the module "TMDb PHP API class - API 'themoviedb." is Jonas De Smet (Glamorous)

the original code is avaible in https://github.com/glamorous/TMDb-PHP-API/blob/master/TMDb.php

 I _DO_ maintain this code, and Jonas De Smet has nothing to do with the update of this code.  
 Any questions directly related to this class library should be directed to me.



## Requirements ##

- PHP 5.2.x or higher
- cURL
- TMDB API-key

## How to use ##

### Initialize the class ###

    <?php
	    include('tmdb_v3.php');
	    
		//Insert your api key of TMDB    
		$apikey="YOUR_APIKEY";

		$tmdb_V3 = new TMDBv3($apikey);	?>

	?>

### Search a Movie ###

    <?php
		//Title to search for
		$title = 'back to the future';
		$language='es'

		$searchTitle = $tmdb_V3->searchMovie('$title','$language');

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

We didn't find any bugs (yet). If you find one, please inform us with the issue tracker on [github](http://github.com/glamorous/TMDb-PHP-API/issues).

## Changelog ##


**TMDb 0.0.1**

- This is the first version of the class without inline documentation or testing   

## TO DO ##

Comment the code.
Documentation.


## License ##

This plugin has a [BSD License](http://www.opensource.org/licenses/bsd-license.php). You can find the license in license.txt that is included with class-package


