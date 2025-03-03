<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    
    <a href="../index.php"><button type="button" id="home">Home</button></a>

    <a href="#home"><button type="button" class="scroll-up-btn">TOP</button></a>

    <?php
    include("db_connection.php");
    
    //gets table data for specific queries
    function getTableData($conn, $query){
        $result = $conn->query($query);
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
    
    $query_list = ["SELECT Patient.E_first_name, Patient.E_last_name, insurance.NAME 
    FROM Patient JOIN covered_by ON Patient.P_ID_NO = covered_by.P_ID_NO JOIN insurance
    ON covered_by.I_ID_NO = insurance.I_ID_NO;", 
    "SELECT COUNT(salary) FROM Therapists WHERE salary > 100000;",
    "SELECT DISTINCT(country) FROM Address_P;",
    "SELECT house_number, city, street, state, zip_code, country FROM Address_P GROUP BY COUNTRY;",
    "SELECT SUM(Salary) FROM therapists WHERE Salary > 80000;"];
    
    $count = 1;
    foreach($query_list as $query){
        $path = "sql-query-{$count}.php";
        $content = "<?php require_once('../queries-connect.php'); 
                    getTableData(\$conn, '{$query}'); 
                    mysqli_close(\$conn);?>";
        file_put_contents($path, $content);
        $count += 1;
    }
?>
</body>
</html>