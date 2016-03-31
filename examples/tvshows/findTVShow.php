<?php
    $found = $tmdb->find('tt3032476');
    $tvShows = $found['tvshows'];

    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    tt3032476 would be a IMDB id.
                    <ul>';
    foreach($tvShows as $tvShow){
        echo '          <li>'. $tvShow->getName() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>