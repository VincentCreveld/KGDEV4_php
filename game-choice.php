

<html>

<body>
    <?php
        include "includes.inc";
    
        $var = "*";
        $table = "Games";
        $query = "SELECT ".$var." FROM " .$table;
        
    
        if (!($result = $mysqli->query($query)))
            showerror($mysqli->errno,$mysqli->error);
        
        ///Is an array with all the results
        $row = $result->fetch_assoc();
        ///Loops as long as there are elements in the $row variable
        echo"game: <select name='gameid' form='game'>";

        do {
            echo "<option value=".$row["id"].">".$row["name"]."</option>";
        } while ($row = $result->fetch_assoc());

        echo"</select><br>";
?>
    <form action="/~vincent.creveld/KGDEV4/game-choice-submit.php" method="post" id="game">
        id: <input type="number" name="id"><br>
        score: <input type="number" name="score"><br>
        session duration in hours: <input type="number" name="timeToAdd"><br>
        <input type="submit">
    </form>
    
    </body>


</html>