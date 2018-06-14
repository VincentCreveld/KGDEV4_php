<html>
<?php 
include "includes.inc";
$gameid = $_GET["gameid"];
    if(isset($_GET["id"]))
        $id = $_GET["id"];
    else
        $id = $_SESSION["id"];
$gameid = $_GET["gameid"];
$score = $_GET["score"];

echo "Submit succesful."; 

$query = "INSERT INTO Scores(instance, gameid, id, score, dateadded) VALUES(NULL, $gameid, $id, $score, NULL)";

    if (!($result = $mysqli->query($query)))
            showerror($mysqli->errno,$mysqli->error);
    $_SESSION["message"] = "Data succesfully added.";
    header("Location: index.php");
?>
</html>