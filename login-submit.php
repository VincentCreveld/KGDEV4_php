<?php
include "includes.inc";

if(isset($_SESSION))
    session_destroy();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = $_POST["email"];
    $password = $_POST["password"];
}
else if ($_SERVER['REQUEST_METHOD'] === 'GET'){
    $email = $_GET["email"];
    $password = $_GET["password"];
}


$email = filter_var($email, FILTER_SANITIZE_EMAIL);

//validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo("$email is a valid email address</br>");
} else {
    echo("$email is not a valid email address");
    header("Location: /~vincent.creveld/KGDEV4/login-page.php");
        exit;
}

//check if pass contains spaces
if ( preg_match('/\s/',$password) ){
    $_SESSION['message'] = "password contains illegal characters. Try again";
    header("Location: /~vincent.creveld/KGDEV4/login-page.php");
    exit;
}   else{
    echo "password doesn't contain illegal characters.</br>";
}
$password = filter_var($password, FILTER_SANITIZE_ENCODED);
if ($_SERVER['REQUEST_METHOD'] === 'POST')
    $password = hash("sha256", $password);
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
        $_SESSION['message'] = "more than 1 of the same user in the db. Db integrity compromised.";
        header("Location: /~vincent.creveld/KGDEV4/login-page.php");
        exit;
    }else if(mysqli_num_rows($result) == 0){
        session_start();
        $_SESSION['message'] = "wrong credentials. try again.";
        header("Location: /~vincent.creveld/KGDEV4/login-page.php");
    }else{
        $row = mysqli_fetch_array($result);
        echo "valid credentials. have a nice day.</br>";
        echo $row['id'] ."<br>";
        session_start();
        $sid = session_id();
        $_SESSION['id']=$row['id'];
        $jsonData = json_encode($row);
        if ($_SERVER['REQUEST_METHOD'] === 'GET'){
            echo "Redirect to json pushing page here";
            header("Location: loginSucces.php?sid='$sid'&reply='$jsonData'");
            exit;
        }else{
            echo $_SESSION['message'] = "Logged in succesfully have a nice day.";
            header("Location: /~vincent.creveld/KGDEV4/index.php");
            exit;
        }
    }
?>