<!DOCTYPE html>
<html>
  <head>

    <title>.</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta charset="utf-8" />
</head>
<?php
	include("tmdb-api.php");


	$apikey = "Your API Key";
	$tmdb = new TMDB($apikey, 'es');

	echo "test de Octal<br><br>";
	$movie = $tmdb->getMovie(603);
	print_r("Movie: ". $movie->getTrailer());
?>
