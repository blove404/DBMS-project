<?php include("header.html");?>
<style>
    <?php include("style.css")?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h2>Relations</h2>
    <?php
    include("db_connection.php");

    //gets every table name
    $sql = "show TABLES;";
    //gets every table name
    $table_names = [];
    $result = mysqli_query($conn, $sql);
    while($table = mysqli_fetch_array($result)){
        $table_names[] = $table[0];
    }

    $uList = "<ul>";
    foreach($table_names as $table){
        $uList .= '<li><div class="card"><a href="Relations/'.$table.'.php">'.$table.'</a></div></li>';
    }
    $uList .= "</ul>";
    echo $uList;

    ?>
    <hr>
    <h2>Queries</h2>
    <ol>
        <a href="sql-queries/sql-query-1.php"><li class="queries">SELECT Patient.E_first_name, Patient.E_last_name, insurance.NAME 
        FROM Patient JOIN covered_by ON Patient.P_ID_NO = covered_by.P_ID_NO JOIN insurance
        ON covered_by.I_ID_NO = insurance.I_ID_NO;</li></a> 
        <p>Selects the patient's emergency contact and insurance (different from the query in part 6)
        </p>
        <br>

        <a href="sql-queries/sql-query-2.php"><li class="queries">SELECT COUNT(salary) FROM Therapists WHERE salary > 100000;</li></a>
        <p>Selects the amount of people who have a salary more than 100,000</p>
        <br>

        <a href="sql-queries/sql-query-3.php"><li class="queries">SELECT DISTINCT(country) FROM Address_P;</li></a>
        <p>Selects each indiviual country where the patients live in.</p>
        <br>

        <a href="sql-queries/sql-query-4.php"><li class="queries">SELECT house_number, city, street, state, zip_code, country FROM Address_P GROUP BY COUNTRY;</li></a>
        <p>Selects an address from each country.</p>
        <br>

        <a href="sql-queries/sql-query-5.php"><li class="queries">SELECT SUM(Salary) FROM therapists WHERE Salary > 80000;</li></a>
        <p>Selects the total salary amount for therapists that are making more than 80,000</p>

    </ol>
    
    <?php
    
    ?>
    <hr>

    <h2>Ad Hoc Query</h2>
    <!-- Text box for input along with submit and clear buttons -->
    
    <form method="post" action="Results.php" id="form-box">
        <textarea name="query" rows="2" cols="50" placeholder="Enter SQL query" id="queryBox"></textarea>
        <br>
        <input type="submit" name="submit" value="Submit">
        <input type="button" value="Clear" onclick="clearQuery()">
    </form>
    <hr>
    
</body>
</html>
<script>
    // for the clear query function
        function clearQuery() {
            document.getElementById("queryBox").value = "";
        }
    </script>
