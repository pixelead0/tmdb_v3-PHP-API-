<?php
$movie = $tmdb->getMovie(11);
echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now the <b>$movie</b> var got all the data, check the <a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/class-Movie.html">documentation</a> for the complete list of methods.<br><br>

                    <b>' .
    $movie->getTitle() .
    '</b>
                    <ul>
                        <li>ID: ' .
    $movie->getID() .
    '</li>
                        <li>Tagline: ' .
    $movie->getTagline() .
    '</li>';
if ($movie->getTrailer() !== null) {
    echo '<li>Trailer: <a href="https://www.youtube.com/watch?v=' . $movie->getTrailer() . '">link</a></li>';
}
echo '</ul>
                    <img src="' .
    $tmdb->getImageURL('w185') .
    $movie->getPoster() .
    '"/></li>
                    <ul>
                        <li>Genres:
                            <ul>';
$genres = $movie->getGenres();
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
$cast = $movie->getCast();
foreach ($cast as $person) {
    echo '<li>' . $person->getName() . ' </li>';
    echo '<img src="' . $tmdb->getImageURL('w185') . $person->getProfile() . '"/></li>';
}
echo '</ul>
                        </li>
                        <li>Crew:
                            <ul>';
$crew = $movie->getCrew();
foreach ($crew as $person) {
    echo '<li>' . $person->getName() . ' </li>';
    echo '<img src="' . $tmdb->getImageURL('w185') . $person->getProfile() . '"/></li>';
}
echo '</ul>
                        </li>
                    </ul>
                </div>
            </div>';
?>
