<?php
    //get request with clientID, returns either true or false in the data response

    $clientID = $_GET["clientID"];
    $valid = FALSE;
    if ($clientID == ''){
        $response = array('status'=>'400', 'data'=>array('response'=>'null'));
    } else {
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

        $sql = "SELECT clientCode FROM clientCodes ";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                if ($row["clientCode"] == $clientID){
                    $valid = TRUE;
                }
            }
        }
        $conn->close();
    }
    if ($valid == TRUE) {
        $response = array('status'=>'400', 'data'=>array('response'=>'valid'));
    }


    //returning the array
    $response = json_encode($response);
    echo $response;

?>