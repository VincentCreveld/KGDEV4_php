<?php 
if(isset($_GET["json"])){
    $userData = json_decode($_GET["json"]);
    echo $userData;
    //$myObject = new \stdClass();
	$myObject ->sessionID = session_id();
    $myObject -> id = $userData[0];
    $myObject -> email = $userData[1];
    $myObject -> username = $userData[2];
    $myObject -> password = $userData[3];
	$myJson = json_encode($myObject);
    
    echo ($myJson);
    //echo "sid:" .$_GET["sid"]." json:".$_GET["reply"];
    exit;
}
?>