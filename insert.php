
<?php
include "includes.inc";
?>
<html>
<body>
<form action="/~vincent.creveld/KGDEV4/submit.php" method="get">
    <!-- id: <input type="number" name="id"><br> -->
    <?php
        $var = "*";
        $table = "Games";
        $query = "SELECT ".$var." FROM " .$table;
        
    
        if (!($result = $mysqli->query($query)))
            showerror($mysqli->errno,$mysqli->error);
        
        ///Is an array with all the results
        $row = $result->fetch_assoc();
        ///Loops as long as there are elements in the $row variable
        echo"game: <select name='gameid'>";

        do {
            echo "<option value=".$row["id"].">".$row["name"]."</option>";
        } while ($row = $result->fetch_assoc());

        echo"</select><br>";
?>
    score: <input type="number" name="score"><br>
<input type="submit">
</form>

</body>
</html> 