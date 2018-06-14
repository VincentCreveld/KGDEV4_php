<?php
include "includes.inc";

$email = $_POST["email"];
$username = $_POST["username"];
$password = $_POST["password"];
$date = $_POST["date"];
$gender = $_POST["gender"];

$email = filter_var($email, FILTER_SANITIZE_EMAIL);

//validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo("$email is a valid email address</br>");
} else {
    echo("$email is not a valid email address");
    header("Location: /~vincent.creveld/KGDEV4/register-page.php");
        exit;
}

//sanitize username
$username = filter_var($username, FILTER_SANITIZE_STRING);

//check if pass contains spaces
if ( preg_match('/\s/',$password) ){
    $_SESSION['message'] = "password contains illegal characters. Try again";
    header("Location: /~vincent.creveld/KGDEV4/register-page.php");
    exit;
}   else{
    echo "password doesn't contain illegal characters.</br>";
}
$password = filter_var($password, FILTER_SANITIZE_ENCODED);
$password = hash("sha256", $password);


//TO DO check if duplicate entries

$duplicateCheckQuery = "SELECT count(1) FROM Users WHERE username = '$username' OR email = '$email';";


    if (!($result = $mysqli->query($duplicateCheckQuery)))
            showerror($mysqli->errno,$mysqli->error);
    else if($result == 0){
        header("Location: /~vincent.creveld/KGDEV4/registered.php");
        $_SESSION["message"] = "Username or email is already taken";
        exit;
    }

$insertQuery = "INSERT INTO Users(id, email, username, password, dateofbirth, gender) VALUES(NULL, '$email', '$username', '$password', '$date', '$gender')";


    if (!($result = $mysqli->query($insertQuery)))
            showerror($mysqli->errno,$mysqli->error);
    else{
        header("Location: /~vincent.creveld/KGDEV4/registered.php");
        exit;
    }
?>