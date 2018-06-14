
<html>
<?php 
include "menu.inc";
include "includes.inc";

if(!isset($_SESSION["id"]))
    header("Location: login-page.php");

    echo $curEmail = $_POST["curEmail"];
    
    if(!isset($_POST["newEmail"]) || $_POST["newEmail"] == "")
        echo $newEmail = $curEmail;
    else
        echo $newEmail = $_POST["newEmail"];
    
    echo $curPass = $_POST["curPass"];
    
    if(!isset($_POST["newPass"]) || $_POST["newPass"] == "")
        echo $newPass = $curPass;
    else
        echo $newPass = $_POST["newPass"];

$curEmail = filter_var($curEmail, FILTER_SANITIZE_EMAIL);
$newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
    
//validate email
if (!filter_var($curEmail, FILTER_VALIDATE_EMAIL) === false) {
    echo("$curEmail is a valid email address</br>");
} else {
    $_SESSION["message"] = "$curEmail is not a valid email address";
    header("Location: changeUserData.php");
        exit;
}
    
if (!filter_var($newEmail, FILTER_VALIDATE_EMAIL) === false) {
    echo("$newEmail is a valid email address</br>");
} else {
    $_SESSION["message"] = "$newEmail is not a valid email address";
    header("Location: changeUserData.php");
        exit;
}

//check if pass contains spaces
if ( preg_match('/\s/',$curPass) ){
    $_SESSION['message'] = "password contains illegal characters. Try again";
    header("Location: changeUserData.php");
    exit;
}   else{
    echo "password doesn't contain illegal characters.</br>";
}
$curPass = filter_var($curPass, FILTER_SANITIZE_ENCODED);
$curPass = hash("sha256", $curPass);
//check if pass contains spaces
if ( preg_match('/\s/',$newPass) ){
    $_SESSION['message'] = "password contains illegal characters. Try again";
    header("Location: changeUserData.php");
    exit;
}   else{
    echo "password doesn't contain illegal characters.</br>";
}
$newPass = filter_var($newPass, FILTER_SANITIZE_ENCODED);
$newPass = hash("sha256", $newPass);

echo $query =    "UPDATE Users
            SET email = '$newEmail', password = '$newPass'
            WHERE email = '$curEmail' AND password = '$curPass'
            ";

    if (!($result = $mysqli->query($query)))
            showerror($mysqli->errno,$mysqli->error);
    
    
    //$_SESSION["message"] = "Credentials changed. Try logging in.";
    //header("Location: login-page.php");
?>
</html>