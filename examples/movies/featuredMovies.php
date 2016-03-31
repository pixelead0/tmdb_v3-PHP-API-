<?php

    // Latest Movie

    $movie = $tmdb->getLatestMovie();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Latest Movie
                </div>
                <div class="panel-body">
                    '. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)<br>
                </div>
            </div>';

    // Now Playing Movie

    $movies = $tmdb->getNowPlayingMovies();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Now Playing Movies
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($movies as $movie){
        echo '          <li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';

    // Popular Movies

    $movies = $tmdb->getPopularMovies();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Popular Movies
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($movies as $movie){
        echo '          <li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';

    // Top Rated Movies

    $movies = $tmdb->getTopRatedMovies();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Top Rated Movies
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($movies as $movie){
        echo '          <li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';

    // Upcoming Movies

    $movies = $tmdb->getUpcomingMovies();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Upcoming Movies
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($movies as $movie){
        echo '          <li>'. $movie->getTitle() .' (<a href="https://www.themoviedb.org/movie/'. $movie->getID() .'">'. $movie->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>