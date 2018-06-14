<?php 
include "menu.inc";
include "includes.inc";
if (isset($_SESSION['message']))
        {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
if(isset($_GET["reply"])){
    echo $_GET["reply"];
    exit;
}
?>