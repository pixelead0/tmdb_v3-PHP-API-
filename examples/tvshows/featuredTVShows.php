<?php

    // Latest TVShow

    $tvShow = $tmdb->getLatestTVShow();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Latest TVShow
                </div>
                <div class="panel-body">
                    '. $tvShow->getName() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)
                </div>
            </div>';

    // On The Air TVShows

    $tvShows = $tmdb->getOnTheAirTVShows();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    On The Air TVShows
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($tvShows as $tvShow){
        echo '          <li>'. $tvShow->getName() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';

    // Airing Today TVShows

    $tvShows = $tmdb->getAiringTodayTVShows();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Airing Today TVShows
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($tvShows as $tvShow){
        echo '          <li>'. $tvShow->getName() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';

    // Top Rated TVShows

    $tvShows = $tmdb->getTopRatedTVShows();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Top Rated TVShows
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($tvShows as $tvShow){
        echo '          <li>'. $tvShow->getName() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';

    // Popular TVShows

    $tvShows = $tmdb->getPopularTVShows();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Popular TVShows
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($tvShows as $tvShow){
        echo '          <li>'. $tvShow->getName() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';

?>