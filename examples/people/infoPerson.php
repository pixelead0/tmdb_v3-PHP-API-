<?php
    $person = $tmdb->getPerson(85);
    
    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    Now the <b>$person</b> var got all the data, check the <a href="http://code.octal.es/php/tmdb-api/class-Person.html">documentation</a> for the complete list of methods.<br><br>

                    <b>'. $person->getName() .'</b>
                    <ul>
                        <li>ID: '. $person->getID() .'</li>
                        <li>Birthday: '. $person->getBirthday() .'</li>
                        <li>Popularity: '. $person->getPopularity() .'</li>
                    </ul>
                    <img src="'. $tmdb->getImageURL('w185') . $person->getProfile() .'"/>
                </div>
            </div>';
?>