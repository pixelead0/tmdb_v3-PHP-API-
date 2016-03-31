<?php
    $found = $tmdb->find('nm0000652');
    $persons = $found['persons'];

    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    tt3032476 would be a IMDB id.
                    <ul>';
    foreach($persons as $person){
        echo '          <li>'. $person->getName() .' (<a href="https://www.themoviedb.org/tv/'. $person->getID() .'">'. $person->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>