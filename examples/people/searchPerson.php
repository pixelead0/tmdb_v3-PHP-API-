<?php
    $persons = $tmdb->searchPerson("Johnny");

    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>';
    foreach($persons as $person){
        echo '          <li>'. $person->getName() .' (<a href="https://www.themoviedb.org/person/'. $person->getID() .'">'. $person->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>