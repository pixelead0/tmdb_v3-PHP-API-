<?php
    $multiSearchResults = $tmdb->multiSearch("Wesley");

    foreach($multiSearchResults as $mediaType => $searchResults){
        echo '  <div class="panel panel-default">';
        echo '<div class="panel-heading">'.$mediaType.'</div>';
        echo '<div class="panel-body">';
        echo '<ul>';
        foreach($searchResults as $searchResult) {
            if($searchResult->getMediaType() === 'movie') {
                echo '          <li>' . $searchResult->getTitle() . ' (<a href="https://www.themoviedb.org/movie/' . $searchResult->getID() . '">' . $searchResult->getID() . '</a>)</li>';
            }elseif($searchResult->getMediaType() === 'tv' ){
                echo '          <li>' . $searchResult->getName() . ' (<a href="https://www.themoviedb.org/tv/' . $searchResult->getID() . '">' . $searchResult->getID() . '</a>)</li>';
            }elseif($searchResult->getMediaType() === 'person'){
                echo '          <li>' . $searchResult->getName() . ' (<a href="https://www.themoviedb.org/person/' . $searchResult->getID() . '">' . $searchResult->getID() . '</a>)</li>';
            }
        }
        echo '</ul></div></div>';
    }
?>