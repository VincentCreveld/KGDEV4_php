<?php
include("includes.inc");
?>
<html>
    <body>
    <h1>Register form</h1>
    <form action="register-submit.php" method="post" id="game">
        email: <input type="email" name="email"><br>
        username: <input type="text" name="username"><br>
        password: <input type="password" name="password"><br>
        date of birth: <input type="date" name="date"><br>
        gender:<br>
        <input type="radio" name="gender" value="m" checked> male<br>
        <input type="radio" name="gender" value="f"> female<br>
        <input type="submit">
    </form>
    <p>Already have an account? <a href="login-page.php">Login here.</a></p>
    </body>


</html>