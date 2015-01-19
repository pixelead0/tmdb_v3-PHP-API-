<!DOCTYPE html>
<html>
    <head>
        <title>API usage for TVShows</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta charset="utf-8" />
    </head>
    <body>
        <?php
            include("../tmdb-api.php");

            $apikey = "Your API Key";
            $tmdb = new TMDB($apikey, 'en', true);

            echo '<h2>API Usage for TVShow examples</h2>';

            // 1. Search TVShow

            echo '<ol><li><a id="searchTVShow"><h3>Search TVShow</h3></a><ul>';

            $tvShows = $tmdb->searchMovie("breaking bad");
            foreach($tvShows as $tvShow){
                echo '<li>'. $tvShow->getTitle() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)</li>';
            }

            echo '</ul></li><hr>';

            // 2. Full Movie Info

            echo '<li><a id="tvShowInfo"><h3>Full TVShow Info</h3></a>';

            $tvShow = $tmdb->getTVShow(1396);
            echo 'Now the <b>$tvShow</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-TVShow.html">documentation</a> for the complete list of methods.<br><br>';

            echo '<b>'. $tvShow->getName() .'</b><ul>';
            echo '  <li>ID:'. $tvShow->getID() .'</li>';
            echo '  <li>Overview: '. $tvShow->getOverview() .'</li>';
            echo '  <li>Number of Seasons: '. $tvShow->getNumSeasons() .'</li>';
            echo '  <li>Seasons: <ul>';
            $seasons = $tvShow->getSeasons();
            foreach($seasons as $season){
                echo '<li><a href="https://www.themoviedb.org/tv/season/'. $season->getID() .'">Season '. $season->getSeasonNumber() .'</a></li>';
            }
            echo ' </ul></ul>';
            echo '<img src="'. $tmdb->getImageURL('w185') . $tvShow->getPoster() .'"/><br>...<hr>';

            // 3 Get Season Info

            echo '<li><a id="seasonInfo"><h3>Full Season Info</h3></a>';

            $season = $tmdb->getSeason($tvShow->getID(), 2);
            echo 'Now the <b>$season</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Season.html">documentation</a> for the complete list of methods.<br><br>';

            echo '<b>'. $season->getName() .'</b><ul>';
            echo '  <li>ID: '. $season->getID() .'</li>';
            echo '  <li>AirDate: '. $season->getAirDate() .'</li>';
            echo '  <li>Number of Episodes: '. $season->getNumEpisodes() .'</li>';
            echo '  <li>Episodes: <ul>';
            $episodes = $season->getEpisodes();
            foreach($episodes as $episode){
                echo '<li><a href="https://www.themoviedb.org/tv/'. $episode->getTVShowID() .'/season/'. $episode->getSeasonNumber() .'/episode/'. $episode->getEpisodeNumber() .'">'. $episode->getEpisodeNumber() .' - '. $episode->getName() .'</a></li>';
            }
            echo ' </ul></ul>...<hr>';

            // 4 Get Episode Info

            echo '<li><a id="episodeInfo"><h3>Full Episode Info</h3></a>';

            $episode = $tmdb->getEpisode($tvShow->getID(), 2, 8);
            echo 'Now the <b>$episode</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Episode.html">documentation</a> for the complete list of methods.<br><br>';

            echo '<b>'. $episode->getEpisodeNumber() .' - '. $episode->getName() .'</b><ul>';
            echo '  <li>ID: '. $episode->getID() .'</li>';
            echo '  <li>AirDate: '. $episode->getAirDate() .'</li>';
            echo '  <li>Vote Average: '. $episode->getVoteAverage() .'</li>';
            echo '  <li>Vode Count: '. $episode->getVoteCount() .'</li>';
            echo ' </ul></ul>...<hr>';
        ?>
    </body>
</html>