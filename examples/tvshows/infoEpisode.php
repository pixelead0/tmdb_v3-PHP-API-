<?php
    $episode = $tmdb->getEpisode(1396, 2, 8);

    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now the <b>$episode</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Episode.html">documentation</a> for the complete list of methods.<br><br>

                    <b>'. $episode->getEpisodeNumber() .' - '. $episode->getName() .'</b>
                    <ul>
                        <li>ID: '. $episode->getID() .'</li>
                        <li>AirDate: '. $episode->getAirDate() .'</li>
                        <li>Vote Average: '. $episode->getVoteAverage() .'</li>
                        <li>Vode Count: '. $episode->getVoteCount() .'</li>
                    </ul>
                </div>
            </div>';
?>