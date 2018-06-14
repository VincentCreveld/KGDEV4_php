<?php
echo "hoi";
include("includes.inc");


if (isset($_SESSION['message']))
{
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
?>
<html>
    <body>
    <h1>Login form</h1>
    <form action="/~vincent.creveld/KGDEV4/login-submit.php" method="post" id="game">
        email: <input type="email" name="email"><br>
        password: <input type="password" name="password"><br>
        <input type="submit">
    </form>
    <p>Don't have an account yet? <a href="register-page.php">Register here.</a></p>
    </body>


</html>