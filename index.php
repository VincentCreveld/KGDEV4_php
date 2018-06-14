<html>
    <head>
    <?php
        include "includes.inc";
        if (isset($_SESSION['message']))
        {
            echo $_SESSION['message'];
            unset($_SESSION['message']);
        }
        
    ?>
         <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <h1>KGDEV4 Vincent Creveld</h1>
    <body>
        <a href = "login-page.php">login/register</a><br>
        <a href = "highscore.php">highscores</a><br>
    <?php 
        if(isset($_SESSION["id"])){
            echo "<a href = 'changeUserData.php'>change credentials</a><br>";
            echo "<a href = 'insert.php'>insert into db</a><br>";
        }
    ?>
        
    </body>
    <footer>
        Hoi ik ben een footer
    </footer>
</html>



<!-- 
        $var = "*";
        $query = "SELECT ".$var." FROM Scores WHERE score > 100 AND (gameid = 2 OR gameid = 3)";
        
        $frontTag = "<p class='results'>";
        $endTag = "</p>";
    
        if (!($result = $mysqli->query($query)))
            showerror($mysqli->errno,$mysqli->error);
        
        ///Is an array with all the results
        $row = $result->fetch_assoc();
        //echo json_encode($row);
        ///Loops as long as there are elements in the $row variable
        do {
            echo $frontTag . $row["score"]. " - " . $row["gameid"] . $endTag;
        } while ($row = $result->fetch_assoc());
-->