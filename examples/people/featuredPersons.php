<?php
    // Latest Person

    $person = $tmdb->getLatestPerson();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Latest Person
                </div>
                <div class="panel-body">
                    '. $person->getName() .' (<a href="https://www.themoviedb.org/tv/'. $person->getID() .'">'. $person->getID() .'</a>)
                </div>
            </div>';

    // On The Air TVShows

    $persons = $tmdb->getPopularPersons();
    echo '  <div class="panel panel-default">
                <div class="panel-heading">
                    Popular persons
                </div>
                <div class="panel-body">
                    <ul>';
    foreach($persons as $person){
        echo '          <li>'. $person->getName() .' (<a href="https://www.themoviedb.org/tv/'. $person->getID() .'">'. $person->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>