<?php
    $tvShows = $tmdb->searchTVShow("breaking bad");

    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>';
    foreach($tvShows as $tvShow){
        echo '          <li>'. $tvShow->getName() .' (<a href="https://www.themoviedb.org/tv/'. $tvShow->getID() .'">'. $tvShow->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>