<!DOCTYPE html>
<html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" type="text/css" href="footer-dark.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="img.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Home</title>
    </head>
    <body>
    <script src="https://use.fontawesome.com/7ad89d9866.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <nav class="navbar navbar-light bg-light">
            <span class="navbar-brand mb-0 h1">TL; DL Spotify</span>
        </nav>
        <script>
                    var once = true;
                    function good() {
                        if (once = true) {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                var x = 0;
                            };
                            xhttp.open("POST", "ops.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send("valued=like");
                        }
                        once = false;
                    }
                    function bad() {
                        if (once = true) {
                            var xhttp = new XMLHttpRequest();
                            xhttp.onreadystatechange = function() {
                                var x = 0;
                            };
                            xhttp.open("POST", "ops.php", true);
                            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                            xhttp.send("valued=dislike");
                        }
                        once = false;
                    }
               
        </script>
        <?php

                $email = $_GET["id"];

                $tokens = [];
                $tracks = [];
                class Token {
                    function __construct($userID, $userEmail, $access_token){
                        $this->userID = $userID;
                        $this->userEmail = $userEmail;
                        $this->access_token = $access_token;
                    }
                }
                class Track {
                    function __construct($userID, $trackID){
                        $this->userID = $userID;
                        $this->trackID = $trackID;
                    }
                }

                $servername = "localhost";
                $username = "markg";
                $password = "/someWHERE924";
                $dbname = "spotifyData";
                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT userCode.userID, userCode.userEmail, userToken.access_token FROM userToken INNER JOIN userCode ON userToken.tokenID = userCode.userID WHERE userCode.userEmail='$email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                        array_push($tokens, new Token($row["userID"], $row["userEmail"], $row["access_token"]));
                    }
                }
                $conn->close();

                foreach ($tokens as $token){
                    $url = 'https://api.spotify.com/v1/me/top/tracks?time_range=long_term&limit=50';
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, [
                        'Authorization: Bearer ' . $token->access_token,
                        'Accept: application/json',
                        'Content-Type: application/json'
                        ]);
                    $response = curl_exec($curl);
                    curl_close($curl);

                    $response = json_decode($response);

                    foreach ($response->items as $item){
                        array_push($tracks, New Track($token->userID, $item->id));
                    }

                }

                $NofTracks = 0;
                $danceability = 0;
                $energy = 0;
                $loudness = 0;
                $mode = 0;
                $speechiness = 0;
                $acousticness = 0;
                $instrumentalness = 0;
                $liveness = 0;
                $valence = 0;
                $tempo = 0;
                $duration_ms = 0;
                $seed_tracks = $response->items[0]->id.','.$response->items[1]->id.','.$response->items[2]->id.','.$response->items[3]->id.','.$response->items[4]->id;

                foreach ($tracks as $track){
                    $url = 'https://api.spotify.com/v1/audio-features/' . $track->trackID;
                    $curl = curl_init($url);
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($curl, CURLOPT_HTTPHEADER, [
                        'Authorization: Bearer ' . $token->access_token,
                        'Accept: application/json',
                        'Content-Type: application/json'
                        ]);
                    $response = curl_exec($curl);
                    curl_close($curl);

                    $response = json_decode($response);

                    $NofTracks = 0 + 1;
                    $danceability = 0 + $response->danceability;
                    $energy = 0 + $response->energy;
                    $loudness = 0 + $response->loudness;
                    $mode = 0 + $response->mode;
                    $speechiness = 0 + $response->speechiness;
                    $acousticness = 0 + $response->acousticness;
                    $instrumentalness = 0 + $response->instrumentalness;
                    $liveness = 0 + $response->liveness;
                    $valence = 0 + $response->valence;
                    $tempo = 0 + $response->tempo;
                    $duration_ms = 0 + $response->duration_ms;
                }
                $danceability = number_format($danceability / $NofTracks, 1, '.', '');
                $energy = number_format($energy / $NofTracks, 1, '.', '');
                $loudness = number_format($loudness / $NofTracks, 1, '.', '');
                $mode = number_format($mode / $NofTracks, 1, '.', '');
                $speechiness = number_format($speechiness / $NofTracks, 1, '.', '');
                $acousticness = number_format($acousticness / $NofTracks, 1, '.', '');
                $instrumentalness = number_format($instrumentalness / $NofTracks, 1, '.', '');
                $liveness = number_format($liveness / $NofTracks, 1, '.', '');
                $valence = number_format($valence / $NofTracks, 0, '.', '');
                $tempo = number_format($tempo / $NofTracks, 1, '.', '');
                $duration_ms = 255886;

                $url = 'https://api.spotify.com/v1/recommendations?limit=1&market=GB&min_popularity=50&target_popularity=75&seed_tracks='.$seed_tracks.'&target_acousticness='.$acousticness.'&target_danceability='.$danceability.'&target_energy='.$energy.'&target_instrumentalness='.$instrumentalness.'&target_liveness='.$liveness.'&target_loudness='.$loudness.'&target_speechiness='.$speechiness.'&target_tempo='.$tempo.'&target_valence='.$valence.'';
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_HTTPHEADER, [
                    'Authorization: Bearer ' . $token->access_token,
                    'Accept: application/json',
                    'Content-Type: application/json'
                    ]);
                $response = curl_exec($curl);
                curl_close($curl);
                $response = json_decode($response);
                foreach ($response->tracks as $item){
                    $temp = $item->external_urls->spotify;
                }
                $temp = '<iframe src="'.$temp.'" width="300px" height="80px" frameborder="0" allowtransparency="true" allow="encrypted-media"></iframe>';
                $temp = str_replace('.com', '.com/embed', $temp);
            ?>

        <div class="imgntext">
            <img src="background.jpg" style="height:100%;width:100%;" alt="Background Image">
            <div class="centered">

            
            <?php
            echo $temp;
            ?>

            <br />

            <div class="rating">
                <!-- Thumbs up -->
                <div class="like grow">
                    <button onclick="good()" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;" class="fa fa-thumbs-up fa-3x like" aria-hidden="true"></button>
                </div>
                <!-- Thumbs down -->
                <div class="dislike grow">
                <button onclick="bad()" style="background-color: Transparent;background-repeat:no-repeat;border: none;cursor:pointer;overflow: hidden;outline:none;" class="fa fa-thumbs-down fa-3x like" aria-hidden="true"></button>
                </div>
            </div>
            <script>
                var once = true;
                $('.like, .dislike').on('click', function() {
                    event.preventDefault();
                    $('.active').removeClass('active');
                    $(this).addClass('active');
                });
                
            </script>
                
            </div>
        </div>
        <div class="footer-dark">
            <footer>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-md-3 item">
                            <h3>TLDL.dev</h3>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="redirect.php">Signup</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6 col-md-3 item">
                            <h3>More TL; DL</h3>
                            <ul>
                                <li><a href="https://github.com/markgraham924/TLDR">Github</a></li>
                                <li><a href="https://trello.com/b/em1SQhK9/tl-dl-spotify">Trello</a></li>
                            </ul>
                        </div>
                        <div class="col-md 6 item text">
                            <h3>TL; DL</h3>
                            <p>An asset of Layered Network managed within the GMPAUTO.co.uk network</p>
                        </div>
                        <div class="col item social">
                            <a href="https://twitter.com/MarkG924"><i class="icon ion-social-twitter"></i></a>
                            <a href="https://www.instagram.com/_mark.graham/"><i class="icon ion-social-instagram"></i></a>
                        </div>
                    </div>
                    <p class="copyright">Mark Graham (Layered Network) &copy; 2019</p>
                </div>
            </footer>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>