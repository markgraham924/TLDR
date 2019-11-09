<?php

    if(!isset($_SESSION["code"])){
        header("Location: https://gmpauto.co.uk/spotify/index.php");
    }
    //gets the user access code
    $_SESSION["code"] = $_GET["code"];

?>

<form action="submit.php" method="POST">
    <input type="email" name="email" required>
    <input type="submit">
</form>