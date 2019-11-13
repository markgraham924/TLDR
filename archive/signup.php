<?php

    if(!isset($_SESSION["code"])){
        header("Location: https://gmpauto.co.uk/spotify/index.php");
    }
    //gets the user access code
    $_SESSION["code"] = $_GET["code"];

?>

<form action="submit.php" method="POST">
    <label>Name: <input type="text" name="email" required></label>
    <input type="submit">
</form>