
<?php
include "includes.inc";

if(!isset($_SESSION["id"]))
    header("Location: login-page.php");

if (isset($_SESSION['message']))
{
    echo $_SESSION['message'];
    unset($_SESSION['message']);
}
    
?>
<html>
<body>
    <h2>Change user details</h2>
<form action="submitUserData.php" method="post">
    current email: <input type="email" name="curEmail" required><br>
    current password: <input type="password" name="curPass" required><br>
    new email: <input type="email" name="newEmail"><br>
    new password: <input type="password" name="newPass"><br>
<input type="submit">
</form>

</body>
</html> 