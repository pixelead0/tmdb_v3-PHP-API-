<?php
$collection = $tmdb->getCollection(121938);

echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now the <b>$collection</b> var got all the data, check the <a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/class-Collection.html">documentation</a> for the complete list of methods.<br><br>

                    <b>' .
    $collection->getName() .
    '</b>
                    <ul>
                        <li>ID: ' .
    $collection->getID() .
    '</li>
                        <li>Overview: ' .
    $collection->getOverview() .
    '</li>
                        <li>Movies: 
                            <ul>';
$movies = $collection->getMovies();
foreach ($movies as $movie) {
    echo '                  <li>' .
        $movie->getTitle() .
        ' (<a href="https://www.themoviedb.org/movie/' .
        $movie->getID() .
        '">' .
        $movie->getID() .
        '</a>)</li>';
}
echo '                  </ul>
                        </li>
                    </ul>
                    <img src="' .
    $tmdb->getImageURL('w185') .
    $collection->getPoster() .
    '"/>
                </div>
            </div>';
?>
