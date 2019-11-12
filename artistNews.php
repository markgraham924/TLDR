<?php

    $email = $_GET["email"];

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
        $url = 'https://api.spotify.com/v1/me/top/artists?time_range=long_term&limit=1';
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
            array_push($tracks, New Track($token->userID, $item->name));
        }

    }

    //auth nonce
    $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
    // Output: 54esmdr0qf
    $oauth_nonce = substr(str_shuffle($permitted_chars), 0, 32);
    $oauth_timestamp = time();
    //signature
    function generateSignature($request, $timestamp, $nonce, $signatureMethod, $version)
        {
            $base = $request['method'] . "&" . rawurlencode($request['url']) . "&"
                . rawurlencode("oauth_consumer_key=" . rawurlencode('e0aCcRbNoE7mKSvXMoM7EyO1j')
                . "&oauth_nonce=" . rawurlencode($nonce)
                . "&oauth_signature_method=" . rawurlencode($signatureMethod)
                . "&oauth_timestamp=" . $timestamp
                . "&oauth_version=" . $version);

            $key = rawurlencode('dgYSJDFzD9efZwcnh285jxncVQ1cTu1QCC3llBD9VCmPsQ0ept') . '&' . rawurlencode('vlVK6bYgySKbuNbxKkffywi4euwjySJeeqHltZNEX8EiS');
            $signature = base64_encode(hash_hmac('sha1', $base, $key, true));

            return $signature;
        }
    
    $url = 'https://api.twitter.com/1.1/users/search.json?q='.$tracks[0]->trackID.'&count=1';
    $oauth_signature = generateSignature($url, $oauth_timestamp, $oauth_nonce, "HMAC-SHA1", "1.0");
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'authorization: OAuth oauth_consumer_key="e0aCcRbNoE7mKSvXMoM7EyO1j"', 
        'oauth_nonce="'.$oauth_nonce.'"',
        'oauth_signature="'.$oauth_signature.'"', 
        'oauth_signature_method="HMAC-SHA1"', 
        'oauth_timestamp="'.$oauth_timestamp.'"', 
        'oauth_token="856588227393855492-trgHWT58Wmv0Pu3zcvSK8rtP3BpKKOR"',
        'oauth_version="1.0"'
        ]);
    $response = curl_exec($curl);
    curl_close($curl);

    echo $response;

?>  