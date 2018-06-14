<?php 
include "dbConnect.php";
include "error.php";

$id = $_POST["id"];
$gameid = $_POST["gameid"];
$score = $_POST["score"];

echo "Submit succesful."; 

$query = "INSERT INTO Scores(instance, gameid, id, score, dateadded) VALUES(NULL, $gameid, $id, $score, NULL)";

    if (!($result = $mysqli->query($query)))
            showerror($mysqli->errno,$mysqli->error);
echo "Succesfull posted score with query:. $query";
?>
