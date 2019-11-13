<?php

    if(!isset($_SESSION["code"])){
        header("Location: https://www.tldl.dev/index.php");
    }

    $code = $_SESSION["code"];
    $email = $_POST["email"];

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

    $sql = "INSERT INTO userCode (userEmail, userCode)
    VALUES ('$email', '$code')";

    if ($conn->query($sql) === TRUE) {
        echo "You have successfully signed up!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT userID, userCode FROM userCode";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if($row["userCode"] == $code){
                $userID = $row["userID"];
            }
        }
    }
    $conn->close();

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO  userToken (tokenID, access_token)
    VALUES ('$userID', '')";

    if ($conn->query($sql) === TRUE) {
        echo "You have successfully signed up!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

    header("Location: https://www.tldl.dev/index.php?success=yes");


?>