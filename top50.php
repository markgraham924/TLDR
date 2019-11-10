<?php

    $email = "john@test.co";

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

    $servername = "160.153.131.192";
    $username = "spotifyAdmin";
    $password = "!~YL;?Cg=LOB";
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
        $url = 'https://api.spotify.com/v1/me/top/tracks?time_range=medium_term&limit=10';
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

    $url = 'https://api.spotify.com/v1/recommendations?limit=1&market=GB&min_popularity=50&target_popularity=75&seed_tracks='.$seed_tracks.'&target_acousticness='.$acousticness.'&target_danceability='.$danceability.'&target_duration_ms='.$duration_ms.'&target_energy='.$energy.'&target_instrumentalness='.$instrumentalness.'&target_liveness='.$liveness.'&target_loudness='.$loudness.'&target_speechiness='.$speechiness.'&target_tempo='.$tempo.'&target_valence='.$valence.'';
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Authorization: Bearer ' . $token->access_token,
        'Accept: application/json',
        'Content-Type: application/json'
        ]);
    $response = curl_exec($curl);
    curl_close($curl);

    echo $response;


    