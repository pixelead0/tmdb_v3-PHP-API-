<?php
$season = $tmdb->getSeason(1396, 2);

echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now the <b>$season</b> var got all the data, check the <a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/class-Season.html">documentation</a> for the complete list of methods.<br><br>
                    <b>' .
    $season->getName() .
    '</b>
                    <ul>
                        <li>ID: ' .
    $season->getID() .
    '</li>
                        <li>AirDate: ' .
    $season->getAirDate() .
    '</li>
                        <li>Number of Episodes: ' .
    $season->getNumEpisodes() .
    '</li>
                        <li>Episodes: 
                            <ul>';
$episodes = $season->getEpisodes();
foreach ($episodes as $episode) {
    echo '                  <li><a href="https://www.themoviedb.org/tv/' .
        $episode->getTVShowID() .
        '/season/' .
        $episode->getSeasonNumber() .
        '/episode/' .
        $episode->getEpisodeNumber() .
        '">' .
        $episode->getEpisodeNumber() .
        ' - ' .
        $episode->getName() .
        '</a></li>';
}
echo '                  </ul>
                        </li>
                    </ul>
                </div>
            </div>';
