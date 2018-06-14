<?php
include "includes.inc" ;

        if(isset($_POST["game"]))
            $game = $_POST["game"];
        else
            $game = 'MiniBall';
        
        if(isset($_POST["date"]))
            $date = $_POST["date"];
        else
            $date = '0';

        echo "<form action='?' method='post'>View highscores of game </br>";
        $var = "*";
        $table = "Games";
        $query = "SELECT ".$var." FROM " .$table;
        
    
        if (!($result = $mysqli->query($query)))
            showerror($mysqli->errno,$mysqli->error);
        
        ///Is an array with all the results
        $row = $result->fetch_assoc();
        ///Loops as long as there are elements in the $row variable
        echo"game: <select name='game'>";

        do {
            echo "<option value=".$row["name"].">".$row["name"]."</option>";
        } while ($row = $result->fetch_assoc());

        echo"</select><br> highscore:<select name='date'>
            <option value='0'>Alltime highscore</option>
            <option value='7'>Weekly highscores</option>
            <option value='14'>Bi-weekly highscores</option>
            <option value='30'>Monthly highscores</option>
            </select>
            <input type='submit'>
            </form><br><br>";

        $queryTimesPlayed = 
            "SELECT COUNT(s.score) AS playCount, AVG(s.score) AS averageScore 
            FROM Scores s
            LEFT JOIN Games g on s.gameid = g.id
            WHERE g.name = '$game'";

        if (!($resultTimesPlayed = $mysqli->query($queryTimesPlayed)))
            showerror($mysqli->errno,$mysqli->error);
        
        ///Is an array with all the results
        $rowTimesPlayed = $resultTimesPlayed->fetch_assoc();
         do {
            echo $game ." has been played ".round($rowTimesPlayed["playCount"])." times. The average score is ".round($rowTimesPlayed["averageScore"])." points.<br>";
        } while ($row = $result->fetch_assoc());
        

        $dateWeekAgo = strftime(mktime(0, 0, 0, date("m"), date("d")-$date, date("Y")));      
        $dateWeekAgo = date('Y-m-d h:i:s',$dateWeekAgo);
        //LEFT JOIN laat "ghost spelers" zien INNER JOIN filtert deze weg.
        if($date == 0)
            $queryDateSort = 
                "SELECT DISTINCT s.score AS score, s.dateadded AS date, u.username AS username, g.name AS game 
                FROM Scores s 
                LEFT JOIN Users u on s.id = u.id
                LEFT JOIN Games g on s.gameid = g.id
                WHERE g.name = '$game'
                ORDER BY s.score DESC LIMIT 0,10";
        else
            $queryDateSort = 
                "SELECT DISTINCT s.score AS score, s.dateadded AS date, u.username AS username, g.name AS game 
                FROM Scores s 
                LEFT JOIN Users u on s.id = u.id
                LEFT JOIN Games g on s.gameid = g.id
                WHERE g.name = '$game' AND s.dateadded > '$dateWeekAgo'
                ORDER BY s.score DESC LIMIT 0,10";
        $arraykey = 1;

        if (!($result = $mysqli->query($queryDateSort)))
            showerror($mysqli->errno,$mysqli->error);
        
        ///Is an array with all the results
        $row = $result->fetch_assoc();
        switch ($date){
            case 0:
                echo "<h2>All-time highscores</h2>";
                break;
            case 7:
                echo "<h2>Weekly highscores</h2>";
                break;
            case 14:
                echo "<h2>Bi-weekly highscores</h2>";
                break;
            case 30:
                echo "<h2>Monthly highscores</h2>";
                break;
            default:
                echo "<h2>Highscores</h2>";
                break;
        }

        
         do {
            echo $arraykey. " - ". $row["game"]. " - " . $row["username"]. " - " . $row["score"]. " - " . $row["date"] ."<br>";
             $arraykey++;
        } while ($row = $result->fetch_assoc());

?>