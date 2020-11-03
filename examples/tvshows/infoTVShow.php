<?php
$tvShow = $tmdb->getTVShow(1396);

echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now the <b>$tvShow</b> var got all the data, check the <a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/class-TVShow.html">documentation</a> for the complete list of methods.<br><br>

                    <b>' .
    $tvShow->getName() .
    '</b>
                    <ul>
                        <li>ID:' .
    $tvShow->getID() .
    '</li>
                        <li>Overview: ' .
    $tvShow->getOverview() .
    '</li>
                        <li>Number of Seasons: ' .
    $tvShow->getNumSeasons() .
    '</li>';
    
    $trailers = $tvShow->getTrailers();
    echo '<li>Trailers:</li>';
    echo '<ul>';
    foreach ($trailers as $trailer) {
        echo '<li>Trailer '.$trailer['name'].': <a href="https://www.youtube.com/watch?v=' . $trailer['key'] . '">link</a></li>';
    }
    echo '</ul>';

    echo '<li>Seasons: 
                            <ul>';
$seasons = $tvShow->getSeasons();
foreach ($seasons as $season) {
    echo '          <li><a href="https://www.themoviedb.org/tv/season/' .
        $season->getID() .
        '">Season ' .
        $season->getSeasonNumber() .
        '</a> EpisodeCount: '.$season->getEpisodeCount().'</li>';
}
echo '          </ul>
                        </li>
                    </ul>
                    <img src="' .
    $tmdb->getImageURL('w185') .
    $tvShow->getPoster() .
    '"/>
                    <ul>
                        <li>Genres:
                            <ul>';
$genres = $tvShow->getGenres();
foreach ($genres as $genre) {
    echo '<li>ID: ' . $genre->getID() . ' </li>';
    echo '<li>Name: ' . $genre->getName() . ' </li>';
}
echo '</ul>
                        </li>
                    </ul>
                    <ul>
                        <li>Cast:
                            <ul>';
$cast = $tvShow->getCast();
foreach ($cast as $person) {
    echo '<li>' . $person->getName() . ' </li>';
    echo '<img src="' . $tmdb->getImageURL('w185') . $person->getProfile() . '"/></li>';
}
echo '</ul>
                        </li>
                        <li>Crew:
                            <ul>';
$crew = $tvShow->getCrew();
foreach ($crew as $person) {
    echo '<li>' . $person->getName() . ' </li>';
    echo '<img src="' . $tmdb->getImageURL('w185') . $person->getProfile() . '"/></li>';
}
echo '</ul>
                        </li>
                    </ul>
                </div>
            </div>';
