<?php

$valued = $_POST["valued"];

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

    $sql = "INSERT INTO nops (valued)
    VALUES ('$valued')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
?>