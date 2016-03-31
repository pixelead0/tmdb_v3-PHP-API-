<?php

    $collections = $tmdb->searchCollection("the hobbit");

    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>';
    foreach($collections as $collection){
        echo '          <li>'. $collection->getName() .' (<a href="https://www.themoviedb.org/collection/'. $collection->getID() .'">'. $collection->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>