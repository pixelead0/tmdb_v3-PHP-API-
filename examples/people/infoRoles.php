<?php
$person = $tmdb->getPerson(85);

echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now each <b>$movieRole</b> var got all the data, check the <a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/class-MovieRole.html">documentation</a> for the complete list of methods.<br><br>';

$movieRoles = $person->getMovieRoles();
echo '          <b>' .
    $person->getName() .
    '</b> - Roles in <b>Movies</b>: 
                    <ul>';
foreach ($movieRoles as $movieRole) {
    echo '          <li>' .
        $movieRole->getCharacter() .
        ' in <a href="https://www.themoviedb.org/movie/' .
        $movieRole->getMovieID() .
        '">' .
        $movieRole->getMovieTitle() .
        '</a></li>';
}
echo '          </ul><br><hr>

                    Now the <b>$tvShowRole</b> var got all the data, check the <a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/class-TVShowRole.html">documentation</a> for the complete list of methods.<br><br>';

$tvShowRoles = $person->getTVShowRoles();
echo '          <b>' .
    $person->getName() .
    '</b> - Roles in <b>TVShows</b>: 
                    <ul>';
foreach ($tvShowRoles as $tvShowRole) {
    echo '          <li>' .
        $tvShowRole->getCharacter() .
        ' in <a href="https://www.themoviedb.org/tv/' .
        $tvShowRole->getTVShowID() .
        '">' .
        $tvShowRole->getTVShowName() .
        '</a></li>';
}
echo '          </ul>
                </div>
            </div>';
