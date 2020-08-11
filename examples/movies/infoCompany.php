<?php
$company = $tmdb->getCompany(34);

echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now the <b>$company</b> var got all the data, check the <a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/class-Company.html">documentation</a> for the complete list of methods.<br><br>

                    <b>' .
    $company->getName() .
    '</b>
                    <ul>
                        <li>ID: ' .
    $company->getID() .
    '</li>
                        <li>Description: ' .
    $company->getDescription() .
    '</li>
                        <li>Movies: 
                            <ul>';

// in this case, getMovies returns only one page of the movies (20 results)
$movies = $company->getMovies();
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
    $company->getLogo() .
    '"/>
                </div>
            </div>';
?>
