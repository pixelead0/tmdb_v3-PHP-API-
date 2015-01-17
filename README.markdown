## Documentation ##

TMDB API PHP Library - wrapper to API version 3 of [themoviedb.org](http://themoviedb.org).

By using this library maybe you should take a look at the full [Documentation](http://code.octal.es/php/tmdb-api/) of this proyect.

@pakage TMDB-API-PHP<br/>
@author [Alvaro Octal](https://twitter.com/Alvaro_Octal) also on [Github](https://github.com/Alvaroctal)<br/>
@date 17/01/2015<br/>
@version 0.1<br/>

### CREDITS  ###

Forked from a similar [proyect](https://github.com/pixelead0/tmdb_v3-PHP-API-) by [Pixelad0](https://github.com/pixelead0)

### CHANGE LOG ###
  * [17/01/2015] 0.1 - First usable code.
	- Forked from  [/pixelead0/tmdb_v3-PHP-API-](https://github.com/pixelead0/tmdb_v3-PHP-API-).
	- Some modifications and dedicated classes added.
 
## Requirements ##
- PHP 5.2.x or higher
- cURL
- TMDB API-key

## How to use ##
View examples/

### Initialize the class ###
	<?php
		include('tmdb-api.php');

		// Insert your api key of TMDB
		$apikey = 'YOUR_APIKEY';
		$languaje = 'es';
		$tmdb = new TMDB($apikey, $language); // by simply giving $apikey it sets the default lang to 'en'
	?>
## Movies ##
### Search a Movie ###
	<?php
		//Title to search for
		$title = 'back to the future';
		$movies = $tmdb->searchMovie($title);
		// returns an array of Movie Object
		foreach($movies as $movie){
			echo $movie->getTitle() .'<br>;
		}
	?>
returns an array of [Movie](http://code.octal.es/php/tmdb-api/class-Movie.html) Objects.
### Get a Movie ###
You should take a look at the Movie class [Documentation](http://code.octal.es/php/tmdb-api/class-Movie.html) and see all the info you can get from a Movie Object.

	<?php
		$idMovie = 11;
		$movie = $tmdb->getMovie($title);
		// returns a Movie Object
		echo $movie->getTitle();
	?>
returns a [Movie](http://code.octal.es/php/tmdb-api/class-Movie.html) Object.
## TV Shows ##
### Search a TV Show ###
	<?php
		// Title to search for
		$title = 'breaking bad';
		$tvShows = $tmdb->searchTVShow($title);
        foreach($tvShows as $tvShow){
            echo $tvShow->getName() .'<br>';
		}
	?>
returns an array of [TVShow](http://code.octal.es/php/tmdb-api/class-TVShow.html) Objects.
### Get a TVShow ###
You should take a look at the TVShow class [Documentation](http://code.octal.es/php/tmdb-api/class-TVShow.html) and see all the info you can get from a TVShow Object.

	<?php
		//Title to search for
		$idTVShow = 1396;
		$tvShow = $tmdb->getTVShow($idTVShow);
		// returns a TVShow Object
		echo $tvShow->getName();
	?>
returns a [TVShow](http://code.octal.es/php/tmdb-api/class-TVShow.html) Object.
### Get a TVShow's Season ###
You should take a look at the Season class [Documentation](http://code.octal.es/php/tmdb-api/class-Season.html) and see all the info you can get from a Season Object.

	<?php
		//Title to search for
		$idTVShow = 1396;
		$numSeason = 2;
		$season = $tmdb->getSeason($idTVShow, $numSeason);
		// returns a Season Object
		echo $season->getName();
	?>
returns a [Season](http://code.octal.es/php/tmdb-api/class-Season.html) Object.
### Get a TVShow's Episode ###
You should take a look at the Episode class [Documentation](http://code.octal.es/php/tmdb-api/class-Episode.html) and see all the info you can get from a Episode Object.

	<?php
		//Title to search for
		$idTVShow = 1396;
		$numSeason = 2;
		$numEpisode = 8;
		$episode = $tmdb->getEpisode($idTVShow, $numSeason, $numEpisode);
		// returns a Episode Object
		echo $episode->getName();
	?>
returns a [Episode](http://code.octal.es/php/tmdb-api/class-Episode.html) Object.
## Issues/Bugs ##
Bugs are expected, this is still under development, you can [report](https://github.com/Alvaroctal/TMDB-PHP-API/issues) them.

## TO DO LIST ##
- Empty :D, you can [propose](https://github.com/Alvaroctal/TMDB-PHP-API/issues) new functionalities.