<?php
include "dbConnect.php";
include "error.php";

$email = $_POST["email"];
$password = $_POST["password"];



//header("Location: loginSucces.php?sid='$sid'&reply='$email'");
//exit;
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

//validate email
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    header("Location: loginSucces.php?sid='$sid'&reply='invalid email'");
        exit;
}

//check if pass contains spaces
if ( preg_match('/\s/',$password) ){
    header("Location: loginSucces.php?sid='$sid'&reply='illegal pass'");
    echo "pass illegal";
    exit;
}
$password = filter_var($password, FILTER_SANITIZE_ENCODED);
//use FILTER_SANITIZE_ENCODED on pass
//continue

$query = "SELECT * FROM Users WHERE email = '$email' AND password = '$password' LIMIT 1";

    if (!($result = $mysqli->query($query))){
            showerror($mysqli->errno,$mysqli->error);
            exit;
    }


    //$rows = $result->fetch_assoc();
    if(mysqli_num_rows($result)>1){
        session_start();
        echo "more than 1 of the same user in the db. Db integrity compromised.";
        exit;
    }else if(mysqli_num_rows($result) == 0){
        session_start();
        echo "Incorrect credentials";
        exit;
    }else{
        $row = mysqli_fetch_array($result);
        //echo "valid credentials. have a nice day.</br>";
        //echo $row['id'] ."<br>";
        
        session_start();
        $sid = session_id();
        $_SESSION['id']=$row['id'];
        //$myObject = new \stdClass();
	    $myObject ->sessionID = session_id();
        $myObject -> id = $row["id"];
        $myObject -> email = $row["email"];
        $myObject -> username = $row["username"];
        $myObject -> password = $row["password"];
	    $myJson = json_encode($myObject);
    
        echo ($myJson);
        //echo "sid:" .$_GET["sid"]." json:".$_GET["reply"];
        exit;
    
        //header("Location: loginSucces.php?json='$jsonData'");
    }
?>