<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Results</title>
    <style>
        <?php include("style.css"); ?> 
    </style>
</head>
<body>
    <a href="index.php"><button type="button" id="home">Home</button></a><br>
    <a href="#home"><button type="button" class="scroll-up-btn">TOP</button></a>
    <?php
    

    if (!empty($_POST['query'])) {
        // Retrieve the user's query from the form
        $query = $_POST['query'];

        include("db_connection.php");
        //SQL injection prevention and prevents user from dropping tables and doesn't allow certain 
        //characters
         // Check if the query contains the word "Drop" (case-insensitive)
         if (stripos($query, 'Drop') !== false) {
            echo "<br>";
            die("Dropping tables is not allowed.");
        }
        
         // Check if the query contains the chracter < at the beginning of the query string
         if (str_starts_with($query, '<') !== false) {
            echo "<br>";
            die("Using < at the start is not allowed.");
        }
         // Check if the query contains the chracter > at the beginning of the query string
         if (str_starts_with($query, '>') !== false) {
            echo "<br>";
            die("Using > at the start is not allowed.");
        }
         // Check if the query contains the chracter < at the end of query string
         if (str_ends_with($query, '<') !== false) {
            echo "<br>";
            die("Using < at the end is not allowed.");
        }
         // Check if the query contains the chracter > at end of query string
         if (str_ends_with($query, '>') !== false) {
            echo "<br>";
            die("Using > at the end is not allowed.");
        }
         // Check if the query contains the chracter /
         if (stripos($query, '/') !== false) {
            echo "<br>";
            die("Using / is not allowed.");
        }
         // Check if the query contains the chracter --
         if (stripos($query, '--') !== false) {
            echo "<br>";
            die("Using - is not allowed.");
        }
       
        // Execute the query
        $result = $conn->query($query);
        // Output the query results
        if($result === TRUE){
            echo "Table was changed.";
        }else{
            if ($result->num_rows > 0) {
                echo "<table>";
                // Get the column names
                $columnNames = array();
                while ($fieldInfo = $result->fetch_field()) {
                    $columnNames[] = $fieldInfo->name;
                }
                // Output the column names as table headers
                echo "<tr>";
                foreach ($columnNames as $columnName) {
                    echo "<th>$columnName</th>";
                }
                echo "</tr>";
    
                // Output the data rows
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    foreach ($row as $value) {
                        echo "<td>$value</td>";
                    }
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "No results found.";
            }
            }
        }
        
    else if (empty($_POST["query"])){
        echo "No query was inserted!";
    }
        $conn->close();
    
    ?>

</body>
</html>