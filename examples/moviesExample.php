<!DOCTYPE html>
<html>
    <head>
        <title>API usage for Movies</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8" />
    </head>
    <body>
        <?php
            include("../tmdb-api.php");

            $apikey = "Your API Key";
            $tmdb = new TMDB($apikey, 'en', true);

            echo '<h2>API Usage for Movies examples</h2>';

            // 1. Search Movie

            echo '<ol><li><a id="searchMovie"><h3>Search Movie</h3></a><ul>';

            $movies = $tmdb->searchMovie("underworld");
            foreach($movies as $movie){
                echo '<li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
            }

            echo '</ul></li><hr>';

            // 2. Full Movie Info

            echo '<li><a id="movieInfo"><h3>Full Movie Info</h3></a>';

            $movie = $tmdb->getMovie(11);
            echo 'Now the <b>$movie</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Movie.html">documentation</a> for the complete list of methods.<br><br>';

            echo '<b>'. $movie->getTitle() .'</b><ul>';
            echo '  <li>ID:'. $movie->getID() .'</li>';
            echo '  <li>Tagline:'. $movie->getTagline() .'</li>';
            echo '  <li>Trailer: <a href="https://www.youtube.com/watch?v='. $movie->getTrailer() .'">link</a></li>';
            echo '</ul>...';
            echo '<img src="'. $tmdb->getImageURL('w185') . $movie->getPoster() .'"/></li>';

            // 3. Now Playing Movies

            echo '<li><a id="nowPlayingMovies"><h3>Now Playing Movies</h3></a><ul>';

            $movies = $tmdb->nowPlayingMovies();
            foreach($movies as $movie){
                echo '<li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
            }

            echo '</ul></li><hr>';

            // 4. Latest Movie

            echo '<li><a id="latestMovie"><h3>Latest Movie</h3></a>';

            $movie = $tmdb->getLatestMovie();
            echo '- '. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)<br>';

            echo '</li><hr>';

            // 5. Search Collection

            echo '<li><a id="searchCollection"><h3>Search Collection</h3></a><ul>';

            $collections = $tmdb->searchCollection("the hobbit");
            foreach($collections as $collection){
                echo '<li>'. $collection->getName() .' (<a href="https://www.themoviedb.org/collection/'. $collection->getID() .'">'. $collection->getID() .'</a>)</li>';
            }

            echo '</ul></li><hr>';

            // 6. Full Collection Info

            echo '<li><a id="collectionInfo"><h3>Full Collection Info</h3></a>';

            $collection = $tmdb->getCollection(121938);
            echo 'Now the <b>$collection</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Collection.html">documentation</a> for the complete list of methods.<br><br>';

            echo '<b>'. $collection->getName() .'</b><ul>';
            echo '  <li>ID: '. $collection->getID() .'</li>';
            echo '  <li>Overview: '. $collection->getOverview() .'</li>';
            echo '  <li>Movies<ul>';
            $movies = $collection->getMovies();
            foreach ($movies as $movie) {
                echo '<li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
            }
            echo '  </ul></li>';
            echo '</ul>...';
            echo '<img src="'. $tmdb->getImageURL('w185') . $collection->getPoster() .'"/></li>';

            // 7. Search a Company

            echo '<li><a id="searchCompany"><h3>Search Company</h3></a><ul>';

            $companies = $tmdb->searchCompany("Sony");
            foreach($companies as $company){
                echo '<li>'. $company->getName() .' (<a href="https://www.themoviedb.org/company/'. $company->getID() .'">'. $company->getID() .'</a>)</li>';
            }

            echo '</ul></li><hr>';

            // 8. Full Company Info

            echo '<li><a id="companyInfo"><h3>Full Company Info</h3></a>';

            $company = $tmdb->getCompany(34);
            echo 'Now the <b>$company</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Company.html">documentation</a> for the complete list of methods.<br><br>';

            echo '<b>'. $company->getName() .'</b><ul>';
            echo '  <li>ID: '. $company->getID() .'</li>';
            echo '  <li>Description: '. $company->getDescription() .'</li>';
            echo '  <li>Movies<ul>';
            // in this case, getMovies returns only one page of the movies (20 results) 
            $movies = $company->getMovies();
            foreach ($movies as $movie) {
                echo '<li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
            }
            echo '  </ul></li>';
            echo '</ul>...';
            echo '<img src="'. $tmdb->getImageURL('w185') . $company->getLogo() .'"/></li>';
        ?>
    </body>
</html>
