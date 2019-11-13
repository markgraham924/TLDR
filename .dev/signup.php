<?php

    //gets the user access code
    $_SESSION["code"] = $_GET["code"];

    if(!isset($_SESSION["code"])){
        header("Location: https://www.tldl.dev/index.php");
    }
    

?>

<form action="submit.php" method="POST">
    <label>Name: <input type="text" name="email" required></label>
    <input type="submit">
</form>