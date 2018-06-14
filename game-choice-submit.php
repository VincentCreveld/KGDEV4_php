<?php
include "includes.inc";

session_start();
$id = $_GET["id"];
$_SESSION["playerID"]=$id;

echo $_SESSION["playerID"];
?>

<html>

<a href="game-choice.php".$id>gamechoice</a>


</html>