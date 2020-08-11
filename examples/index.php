<?php
$apikey = 'Your API Key';
$selectedZone = array_key_exists('zone', $_GET) ? $_GET['zone'] : null;
$selectedExample = array_key_exists('example', $_GET) ? $_GET['example'] : null;
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TMDB PHP API - Examples</title>

        <!-- Bootstrap CSS  -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

        <!-- Inline CSS -->

        <style type="text/css">
            body {
                background-color: #B1B1B1;
            }

            #main-container {
                background-color: #F1F1F1;
                min-height: 550px;
                border-bottom-left-radius: 8px;
                border-bottom-right-radius: 8px;
                padding-top: 60px;
            }

            #page-title {
                margin-top: 0px;
            }
        </style>
    </head>
    <body>
        
        <!-- NavBar -->

        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">TMDB PHP API - Examples</a>
                </div>

                <?php $zones = [
                    'movies' => [
                        'name' => 'Movies',
                        'examples' => [
                            'searchMovie' => 'Search Movie',
                            'infoMovie' => 'Full Movie Info',
                            'featuredMovies' => 'Featured Movies',
                            'searchMovieByGenre' => 'Search Movie by Genre',
                            '1' => 'hr',
                            'searchCollection' => 'Search Collection',
                            'infoCollection' => 'Full Collection Info',
                            '2' => 'hr',
                            'searchCompany' => 'Search Company',
                            'infoCompany' => 'Full Company Info',
                            'findMovie' => 'Find Movie by external ID',
                        ],
                    ],
                    'tvshows' => [
                        'name' => 'TV Shows',
                        'examples' => [
                            'searchTVShow' => 'Search TV Show',
                            'infoTVShow' => 'Full TVShow Info',
                            'featuredTVShows' => 'Featured TV Shows',
                            'infoSeason' => 'Full Season Info',
                            'infoEpisode' => 'Full Episode Info',
                            'findTVShow' => 'Find TVShow by external ID',
                        ],
                    ],
                    'people' => [
                        'name' => 'People',
                        'examples' => [
                            'searchPerson' => 'Search Person',
                            'infoPerson' => 'Full Person Info',
                            'featuredPersons' => 'Featured Persons',
                            'findPerson' => 'Find Person by external ID',
                            '1' => 'hr',
                            'infoRoles' => 'Full Roles Info',
                        ],
                    ],
                    'search' => [
                        'name' => 'Search',
                        'examples' => [
                            'multiSearch' => 'Multisearch movies, TV Show and Persons',
                        ],
                    ],
                    'genres' => [
                        'name' => 'Genre',
                        'examples' => [
                            'movieGenres' => 'Get a List of Movie Genres',
                            'tvShowGenres' => 'Get a List of TV Show Genres',
                        ],
                    ],
                ]; ?>
                
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                        <?php foreach ($zones as $zoneID => $zone) {
                            echo '  <li class="dropdown ' .
                                ($selectedZone == $zoneID ? 'active' : '') .
                                '">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">' .
                                $zone['name'] .
                                ' <span class="caret"></span></a>
                                            <ul class="dropdown-menu">';
                            foreach ($zone['examples'] as $exampleID => $example) {
                                if ($example == 'hr') {
                                    echo '<li role="separator" class="divider"></li>';
                                } else {
                                    echo '      <li ' .
                                        ($selectedZone == $zoneID && $selectedExample == $exampleID
                                            ? 'class="active"'
                                            : '') .
                                        '><a href="./?zone=' .
                                        $zoneID .
                                        '&example=' .
                                        $exampleID .
                                        '">' .
                                        $example .
                                        '</a></li>';
                                }
                            }
                            echo '      </ul>
                                        </li>';
                        } ?>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="http://pixelead0.github.io/tmdb_v3-PHP-API-/">Documentation</a></li>
                    </ul>
                </div>
            </nav>

            <!-- Container -->

            <div id="main-container" class="container">
                <h3 id="page-title"><?php echo htmlspecialchars($selectedZone . ' - ' . $selectedExample); ?></h3>

                <?php
                include '../tmdb-api.php';

                $tmdb = new TMDB();

                if (null !== $selectedZone && null !== $selectedExample) {
                    $path = './' . $selectedZone . '/' . $selectedExample . '.php';
                } else {
                    $path = null;
                }

                if (strpos($path, '../') === false && file_exists($path)) {
                    include $path;
                } else {
                    echo 'unable to find example (' . $path . ')';
                }
                ?>
            </div>
        </div>
    </body>
</html>

<!-- Bootstrap JS -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
