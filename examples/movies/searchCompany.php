<?php

    $companies = $tmdb->searchCompany("Sony"); 

    echo '  <div class="panel panel-default">
                <div class="panel-body">
                    <ul>';
    foreach($companies as $company){
        echo '<li>'. $company->getName() .' (<a href="https://www.themoviedb.org/company/'. $company->getID() .'">'. $company->getID() .'</a>)</li>';
    }
    echo '          </ul>
                </div>
            </div>';
?>