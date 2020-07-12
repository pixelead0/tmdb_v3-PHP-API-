<?php
    $genres = $tmdb->getMovieGenres();
    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>
                        <li>Genres:
                            <ul>';
                            foreach ($genres as $genre) {
                                echo '<li>ID: '. $genre->getID() .' </li>';
                                echo '<li>Name: '. $genre->getName() .' </li>';
                            }
                            echo '</ul>
                        </li>
                    </ul>
                </div>
            </div>';
?>