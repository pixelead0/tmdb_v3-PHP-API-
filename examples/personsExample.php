<!DOCTYPE html>
<html>
	<head>
		<title>API usage for Persons</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta charset="utf-8" />
	</head>
	<body>
		<?php
			include("../tmdb-api.php");

			$apikey = "Your API Key";
			$tmdb = new TMDB($apikey, 'en', true);

			echo '<h2>API Usage for Persons examples</h2>';

			// 1. Search Person

			echo '<ol><li><a id="searchPerson"><h3>Search Person</h3></a><ul>';

			$persons = $tmdb->searchPerson("Johnny");
			foreach($persons as $person){
				echo '<li>'. $person->getName() .' (<a href="https://www.themoviedb.org/person/'. $person->getID() .'">'. $person->getID() .'</a>)</li>';
			}

			echo '</ul></li><hr>';

			// 2. Full Person Info

			echo '<li><a id="personInfo"><h3>Full Person Info</h3></a><ul>';

			$person = $tmdb->getPerson(85);

			echo 'Now the <b>$person</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Person.html">documentation</a> for the complete list of methods.<br><br>';

			echo '<b>'. $person->getName() .'</b><ul>';
			echo '  <li>ID: '. $person->getID() .'</li>';
			echo '  <li>Birthday: '. $person->getBirthday() .'</li>';
			echo '  <li>Popularity: '. $person->getPopularity() .'</li>';
			echo '</ul>...';
			echo '<img src="'. $tmdb->getImageURL('w185') . $person->getProfile() .'"/>';
			echo '</ul></li><hr>';

			// 3. Get the roles

			echo '<li><a id="personRoles"><h3>Person Roles</h3></a>';

			echo 'Now each <b>$movieRole</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-MovieRole.html">documentation</a> for the complete list of methods.<br><br>';

			$movieRoles = $person->getMovieRoles();
			echo '<b>'. $person->getName() .'</b> - Roles in <b>Movies</b>: <ul>';
			foreach($movieRoles as $movieRole){
				echo '<li>'. $movieRole->getCharacter() .' in <a href="https://www.themoviedb.org/movie/'. $movieRole->getMovieID() .'">'. $movieRole->getMovieTitle() .'</a></li>';
			}
			echo '</ul><br><br>';

			echo 'Now the <b>$tvShowRole</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-TVShowRole.html">documentation</a> for the complete list of methods.<br><br>';

			$tvShowRoles = $person->getTVShowRoles();
			echo '<b>'. $person->getName() .'</b> - Roles in <b>TVShows</b>: <ul>';
			foreach($tvShowRoles as $tvShowRole){
				echo '<li>'. $tvShowRole->getCharacter() .' in <a href="https://www.themoviedb.org/tv/'. $tvShowRole->getTVShowID() .'">'. $tvShowRole->getTVShowName() .'</a></li>';
			}
			echo '</ul></li><hr>';

			// 4. Get the latest added Person

			echo '<li><a id="personLatest"><h3>Latest person</h3></a>';

			$person = $tmdb->getLatestPerson();

			echo 'Latest Person: '. $person->getName() .' (<a href="https://www.themoviedb.org/person/'. $person->getID() .'">'. $person->getID() .'</a>)</li>';
			echo '</li><hr>';

			// 5. Get the most popular Persons

			echo '<li><a id="personPopular"><h3>Popular persons</h3></a>';

			$persons = $tmdb->getPopularPersons();
			echo '<b>List of the most popular people, by simply doing $tmdb->getPopularPeople($page) you can switch between pages.</b>: <ol>';
			foreach($persons as $person){
				echo '<li>'. $person->getName() .' (<a href="https://www.themoviedb.org/person/'. $person->getID() .'">'. $person->getID() .'</a>)</li>';
			}
			echo '</ol></li><hr>';
		?>
	</body>
</html>