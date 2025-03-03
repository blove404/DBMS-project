<style>
    <?php include("style.css")?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <a href="../index.php"><button type="button" id="home">Home</button></a>

    <a href="#home"><button type="button" class="scroll-up-btn">TOP</button></a>

    <?php
        session_start();

        include("db_connection.php");//gets db server information

        $sql = "show TABLES;";
        //gets every table name
        $table_names = [];
        $result = mysqli_query($conn, $sql);
        while($table = mysqli_fetch_array($result)){
            touch($table[0] . ".php");
            $table_names[] = $table[0];
        }

        //queries for each table
        function getTableData($conn, $table){
            $query = "SELECT * FROM $table;";
            $result = mysqli_query($conn, $query);
            $resultCheck = mysqli_num_rows($result);
            
            if($resultCheck > 0){
                echo "<table>";
                $columns = [];
                while($fields = $result->fetch_field()){
                    $columns[] = $fields->name;
                }
                echo "<tr>";
                foreach($columns as $column){
                    echo "<th>$column</th>";
                }
                echo "</tr>";
        
                while($row = $result->fetch_assoc()){
                    echo"<tr>";
                    foreach($row as $value){
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            }
            else{
                echo "No data found.";
            }
        
        }

        

    
        //adds the tables to each php file
        foreach($table_names as $table){
            $path = "{$table}.php";
            $content = "<?php require_once('../sqltest.php'); 
                        getTableData(\$conn, '{$table}'); 
                        mysqli_close(\$conn);?>";
            file_put_contents($path, $content);
        }
        
        //pass table names to index.php
        $_SESSION["table_names"] = $table_names;
    ?>
</body>
</html>
